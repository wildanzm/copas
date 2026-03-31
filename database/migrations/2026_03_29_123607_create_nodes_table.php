<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nodes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->enum('type', ['material', 'quiz']);
            $table->integer('order_index');
            $table->string('video_url')->nullable();
            $table->timestamps();

            $table->index('type');
            $table->index('order_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nodes');
    }
};
