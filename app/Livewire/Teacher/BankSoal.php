<?php

namespace App\Livewire\Teacher;

use App\Models\Question;
use App\Models\QuestionOption;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app.teacher-sidebar')]
#[Title('Copas | Bank Soal')]
class BankSoal extends Component
{
    use \Livewire\WithFileUploads;

    public $questions = [];
    public $quizTime = '20:00';
    public $tempImages = [];

    public function mount()
    {
        $this->loadQuestions();
    }

    public function loadQuestions()
    {
        $this->questions = Question::with('options')
            ->where('type', 'final_quiz')
            ->get()
            ->map(function ($q) {
                return [
                    'id' => $q->id,
                    'content' => $q->content,
                    'image_path' => $q->image_path,
                    'image_settings' => $q->image_settings ?? [
                        'width' => 100,
                        'rotation' => 0,
                        'position' => 'center',
                    ],
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

    public function addQuestion()
    {
        \Illuminate\Support\Facades\DB::transaction(function () {
            $newQuestion = Question::create([
                'type' => 'final_quiz',
                'content' => 'Pertanyaan baru...',
                'image_settings' => [
                    'width' => 100,
                    'rotation' => 0,
                    'position' => 'center',
                ],
            ]);

            $options = [];
            for ($i = 0; $i < 4; $i++) {
                $options[] = [
                    'question_id' => $newQuestion->id,
                    'option_text' => 'Pilihan ' . ($i + 1),
                    'is_correct' => $i === 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            QuestionOption::insert($options);
        });

        $this->loadQuestions();
        
        session()->flash('message', 'Soal baru berhasil ditambahkan!');
        
        $this->dispatch('swal:alert', [
            'icon' => 'success',
            'title' => 'Berhasil!',
            'text' => 'Soal baru telah ditambahkan ke bank soal.',
        ]);
    }

    public function updateQuestionContent($questionId, $content)
    {
        $question = Question::find($questionId);
        if ($question) {
            $question->update(['content' => $content]);
        }
    }

    public function updateOptionText($optionId, $text)
    {
        $option = QuestionOption::find($optionId);
        if ($option) {
            $option->update(['option_text' => $text]);
        }
    }

    public function setCorrectOption($questionId, $optionId)
    {
        \Illuminate\Support\Facades\DB::transaction(function () use ($questionId, $optionId) {
            QuestionOption::where('question_id', $questionId)->update(['is_correct' => false]);
            QuestionOption::where('id', $optionId)->update(['is_correct' => true]);
        });

        $this->loadQuestions();
    }

    public function updatedTempImages($value, $questionId)
    {
        $this->validate([
            'tempImages.' . $questionId => 'image|max:2048',
        ]);

        $question = Question::find($questionId);
        if ($question && isset($this->tempImages[$questionId])) {
            $path = $this->tempImages[$questionId]->store('questions', 'public');
            $question->update([
                'image_path' => $path,
                'image_settings' => [
                    'width' => 100,
                    'rotation' => 0,
                    'position' => 'center',
                ],
            ]);
            $this->loadQuestions();
            
            $this->dispatch('swal:alert', [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'Gambar soal berhasil diperbarui.',
            ]);
        }
    }

    public function updateImageSettings($questionId, $settings)
    {
        $question = Question::find($questionId);
        if ($question) {
            if (isset($settings['remove']) && $settings['remove']) {
                $question->update([
                    'image_path' => null,
                    'image_settings' => null,
                ]);
            } else {
                $question->update(['image_settings' => $settings]);
            }
            $this->loadQuestions();
        }
    }

    public function deleteQuestion($questionId)
    {
        $question = Question::find($questionId);
        if ($question) {
            \Illuminate\Support\Facades\DB::transaction(function () use ($question) {
                $question->options()->delete();
                $question->delete();
            });
            
            $this->loadQuestions();
            
            $this->dispatch('swal:alert', [
                'icon' => 'success',
                'title' => 'Terhapus!',
                'text' => 'Soal telah berhasil dihapus dari bank soal.',
            ]);
        } else {
            $this->dispatch('swal:alert', [
                'icon' => 'error',
                'title' => 'Gagal!',
                'text' => 'Soal tidak ditemukan atau sudah dihapus.',
            ]);
        }
    }

    public function saveAll()
    {
        $this->dispatch('swal:alert', [
            'icon' => 'success',
            'title' => 'Tersimpan!',
            'text' => 'Semua perubahan pada bank soal telah berhasil disimpan.',
        ]);
    }

    public function render()
    {
        return view('livewire.teacher.bank-soal');
    }
}
