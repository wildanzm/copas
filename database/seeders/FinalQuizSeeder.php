<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\QuestionOption;
use Illuminate\Database\Seeder;

class FinalQuizSeeder extends Seeder
{
    public function run(): void
    {
        $markdown = file_get_contents(base_path('docs/quiz.md'));
        $blocks = explode('---', $markdown);

        // Delete all final quiz questions
        $questions = Question::where('type', 'final_quiz')->get();
        foreach ($questions as $q) {
            $q->options()->delete();
            $q->delete();
        }

        foreach ($blocks as $block) {
            $block = trim($block);
            if (empty($block)) {
                continue;
            }

            $lines = explode("\n", $block);
            $contentLines = [];
            $options = [];

            $parsingOptions = false;

            $currentImagePath = null;
            foreach ($lines as $line) {
                $line = trim($line);
                if (empty($line) || str_starts_with($line, '### Soal')) {
                    continue;
                }

                if (str_starts_with($line, '* ')) {
                    $parsingOptions = true;
                    $optionText = substr($line, 2);
                    $isCorrect = false;

                    if (str_starts_with($optionText, '**') && str_ends_with($optionText, '**')) {
                        $isCorrect = true;
                        $optionText = substr($optionText, 2, -2);
                    }

                    $options[] = [
                        'text' => $optionText,
                        'is_correct' => $isCorrect,
                    ];
                } else {
                    if (! $parsingOptions) {
                        // Check if it's an image
                        if (preg_match('/!\[(.*?)\]\((.*?)\)/', $line, $matches)) {
                            $imageName = basename($matches[2]);
                            $currentImagePath = 'questions/' . $imageName;
                        } else {
                            $contentLines[] = '<p class="mb-4">'.e($line).'</p>';
                        }
                    }
                }
            }

            $question = Question::create([
                'type' => 'final_quiz',
                'node_id' => null,
                'content' => implode("\n", $contentLines),
                'image_path' => $currentImagePath,
                'image_settings' => $currentImagePath ? [
                    'width' => 100,
                    'rotation' => 0,
                    'position' => 'center',
                ] : null,
            ]);

            foreach ($options as $opt) {
                QuestionOption::create([
                    'question_id' => $question->id,
                    'option_text' => $opt['text'],
                    'is_correct' => $opt['is_correct'],
                ]);
            }
        }
    }
}
