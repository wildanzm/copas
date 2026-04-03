<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Node;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LearningPathSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function (): void {
            // Node 1
            Node::create([
                'title' => 'Dasar IPAS',
                'description' => 'Pelajari dasar-dasar ilmu pengetahuan alam dan sosial.',
                'type' => 'material',
                'video_url' => 'https://youtu.be/h8jOOd6le30?si=ZS36vAtl8lgutyWe',
                'order_index' => 1,
            ]);

            // Node 2
            Node::create([
                'title' => 'Eksplorasi Interaktif',
                'description' => 'Eksplorasi kasus permasalahan lingkungan di sekitarmu.',
                'type' => 'material',
                'order_index' => 2,
            ]);

            // Node 3
            $node3 = Node::create([
                'title' => 'Kuis Pilihan Ganda',
                'description' => 'Uji pemahamanmu dengan kuis pilihan ganda.',
                'type' => 'quiz',
                'order_index' => 3,
            ]);
            $question3 = $node3->questions()->create([
                'type' => 'multiple_choice',
                'content' => 'Contoh pertanyaan pilihan ganda terkait materi?',
            ]);
            $question3->options()->createMany([
                ['option_text' => 'Pilihan Benar', 'is_correct' => true],
                ['option_text' => 'Pilihan Salah 1', 'is_correct' => false],
                ['option_text' => 'Pilihan Salah 2', 'is_correct' => false],
                ['option_text' => 'Pilihan Salah 3', 'is_correct' => false],
            ]);

            // Node 4
            $node4 = Node::create([
                'title' => 'Tantangan Benar/Salah',
                'description' => 'Tantangan pernyataan benar atau salah.',
                'type' => 'quiz',
                'order_index' => 4,
            ]);
            $question4 = $node4->questions()->create([
                'type' => 'true_false',
                'content' => 'Apakah planet bumi itu bulat?',
            ]);
            $question4->options()->createMany([
                ['option_text' => 'Benar', 'is_correct' => true],
                ['option_text' => 'Salah', 'is_correct' => false],
            ]);

            // Node 5
            $node5 = Node::create([
                'title' => 'Ujian Akhir Level',
                'description' => 'Bagian terakhir yang harus dilalui oleh siswa.',
                'type' => 'quiz',
                'order_index' => 5,
            ]);
            $node5->questions()->create([
                'type' => 'essay',
                'content' => 'Jelaskan kesimpulan yang kamu dapat dari pembelajaran ini.',
            ]);
        });
    }
}
