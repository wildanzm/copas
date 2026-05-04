<?php

namespace App\Livewire\Student;

use App\Models\Question;
use App\Models\StudentAnswer;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.quiz')]
#[Title('Copas | Kuis')]
class PlayQuiz extends Component
{
    public $questions;

    public function mount()
    {
        $this->questions = Question::with('options')
            ->where('type', 'final_quiz')
            ->get()
            ->map(function ($q) {
                return [
                    'id' => $q->id,
                    'content' => $q->content,
                    'image_path' => $q->image_path,
                    'image_settings' => $q->image_settings,
                    'options' => $q->options->map(function ($opt) {
                        return [
                            'id' => $opt->id,
                            'text' => $opt->option_text,
                            'is_correct' => $opt->is_correct,
                        ];
                    })->toArray(),
                ];
            })->toArray();
    }

    public function submitQuiz($answers, $timeSpent)
    {
        return \Illuminate\Support\Facades\DB::transaction(function () use ($answers, $timeSpent) {
            $user = Auth::user();
            
            // Get question IDs once to avoid repeated whereHas queries
            $questionIds = collect($this->questions)->pluck('id')->toArray();
            
            // Get current level and best XP in fewer queries
            $oldLevel = $user->level;
            $currentBestXp = (int) $user->studentAnswers()
                ->whereIn('question_id', $questionIds)
                ->sum('xp_earned');

            $newEarnedXp = 0;
            $correctCount = 0;
            $incorrectCount = 0;
            $maxPossibleXpPerQuestion = 10;
            $newAnswers = [];

            foreach ($this->questions as $q) {
                $answerOptionId = $answers[$q['id']] ?? null;
                $xp = 0;
                $isCorrect = false;

                if ($answerOptionId) {
                    foreach ($q['options'] as $opt) {
                        if ($opt['id'] == $answerOptionId && $opt['is_correct']) {
                            $xp = $maxPossibleXpPerQuestion;
                            $isCorrect = true;
                            break;
                        }
                    }
                }

                if ($isCorrect) {
                    $correctCount++;
                } else {
                    $incorrectCount++;
                }

                $newEarnedXp += $xp;

                $newAnswers[] = [
                    'user_id' => $user->id,
                    'question_id' => $q['id'],
                    'answer_text' => $answerOptionId ? (string) $answerOptionId : null,
                    'xp_earned' => $xp,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Only save to DB if the new score is better than or equal to the previous best
            if ($newEarnedXp >= $currentBestXp) {
                $user->studentAnswers()
                    ->whereIn('question_id', $questionIds)
                    ->delete();

                // Batch insert for performance
                StudentAnswer::insert($newAnswers);
            }

            // Refresh user and get final results
            $user->refresh();
            $newLevel = $user->level;

            return [
                'score' => round(($newEarnedXp / (count($this->questions) * 10)) * 100),
                'correctCount' => $correctCount,
                'incorrectCount' => $incorrectCount,
                'earnedXp' => $newEarnedXp,
                'timeSpent' => $timeSpent,
                'totalXp' => $user->studentAnswers()->sum('xp_earned'),
                'level' => $newLevel,
                'isLevelUp' => $newLevel > $oldLevel,
                'oldLevel' => $oldLevel,
                'isNewBest' => $newEarnedXp > $currentBestXp,
            ];
        });
    }

    public function render()
    {
        return view('livewire.student.play-quiz');
    }
}
