<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->nullable()->after('name');
            $table->unsignedBigInteger('class_id')->nullable()->after('username');

            $table->foreign('class_id')->references('id')->on('classes')->cascadeOnDelete();
            $table->index('username');
            $table->index('class_id');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['class_id']);
            $table->dropColumn(['username', 'class_id']);
        });
    }
};
