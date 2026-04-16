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
            $node1 = Node::create([
                'title' => 'Dasar IPAS',
                'description' => 'Pelajari dasar-dasar ilmu pengetahuan alam dan sosial.',
                'type' => 'material',
                'video_url' => 'https://youtu.be/h8jOOd6le30?si=ZS36vAtl8lgutyWe',
                'order_index' => 1,
            ]);
            $node1->questions()->create([
                'type' => 'essay',
                'content' => 'Apa masalah utama yang terjadi pada video tersebut?',
            ]);
            $node1->questions()->create([
                'type' => 'essay',
                'content' => 'Apa saja dampak yang ditimbulkan dari peristiwa tersebut?',
            ]);
            $node1->questions()->create([
                'type' => 'essay',
                'content' => 'Menurut pendapatmu, apa yang menyebabkan kondisi tersebut bisa terjadi?',
            ]);

            // Node 2
            $node2 = Node::create([
                'title' => 'Ayo Tentukan Benar atau Salah!',
                'description' => 'Evaluasi pemahamanmu tentang lingkungan.',
                'type' => 'quiz',
                'order_index' => 2,
            ]);

            $questionsNode2 = [
                ['text' => 'Sampah yang dibuang ke sungai dapat menyumbat aliran air', 'correct' => 'Benar'],
                ['text' => 'Jika selokan di lingkungan rumah tersumbat sampah, maka membersihkannya dapat membantu mencegah banjir', 'correct' => 'Benar'],
                ['text' => 'Banjir yang terjadi setelah hujan deras tidak ada hubungannya dengan kebiasaan manusia membuang sampah', 'correct' => 'Salah'],
                ['text' => 'Lingkungan yang tampak kotor belum tentu menyebabkan masalah jika tidak berdampak pada kehidupan manusia', 'correct' => 'Salah'],
                ['text' => 'Sebagian besar permasalahan lingkungan di sekitar kita terjadi karena kebiasaan manusia yang tidak menjaga kebersihan lingkungan', 'correct' => 'Benar'],
            ];

            foreach ($questionsNode2 as $qData) {
                $q = $node2->questions()->create([
                    'type' => 'true_false',
                    'content' => $qData['text'],
                ]);
                $q->options()->createMany([
                    ['option_text' => 'Benar', 'is_correct' => $qData['correct'] === 'Benar'],
                    ['option_text' => 'Salah', 'is_correct' => $qData['correct'] === 'Salah'],
                ]);
            }

            // Node 3
            $node3 = Node::create([
                'title' => 'Observasi Lingkungan',
                'description' => 'Amati dan analisis lingkungan sekitarmu.',
                'type' => 'quiz',
                'order_index' => 3,
            ]);
            $node3->questions()->create([
                'type' => 'essay',
                'content' => 'Pilih tempat yang menurutmu menarik untuk diamati. Ambil foto, upload, dan jelaskan gambar tersebut (Jika kotor: penyebab & solusi. Jika bersih: cara menjaga).',
            ]);

            // Node 4
            $node4 = Node::create([
                'title' => 'Mengapa Terjadi dan Bagaimana Solusinya?',
                'description' => 'Mari selesaikan masalah dengan solusi cerdas.',
                'type' => 'material',
                'video_url' => 'https://youtu.be/tVbu49X0aus?si=-5aYw-0RscwIjEDm',
                'order_index' => 4,
            ]);
            $node4->questions()->create([
                'type' => 'essay',
                'content' => 'Apa persamaan masalah yang kamu temukan dengan peristiwa pada video sebelumnya?',
            ]);
            $node4->questions()->create([
                'type' => 'essay',
                'content' => 'Apa solusi yang dapat kamu lakukan untuk mengatasi permasalahan lingkungan di sekitarmu? Mengapa solusi tersebut penting dilakukan?',
            ]);

            // Node 5
            $node5 = Node::create([
                'title' => 'Ayo Lakukan Refleksi',
                'description' => 'Refleksikan apa yang telah dipelajari hari ini.',
                'type' => 'quiz',
                'order_index' => 5,
            ]);
            $node5->questions()->create([
                'type' => 'essay',
                'content' => 'Apa hal baru yang kamu pelajari hari ini?',
            ]);
            $node5->questions()->create([
                'type' => 'essay',
                'content' => 'Mengapa menjaga lingkungan itu penting?',
            ]);
            $node5->questions()->create([
                'type' => 'essay',
                'content' => 'Apa yang akan kamu lakukan mulai sekarang untuk menjaga lingkungan?',
            ]);
        });
    }
}
