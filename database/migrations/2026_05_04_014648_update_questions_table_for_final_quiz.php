<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Alter node_id to be nullable
        Schema::table('questions', function (Blueprint $table) {
            $table->unsignedBigInteger('node_id')->nullable()->change();
        });

        // Modify enum to add 'final_quiz'
        DB::statement("ALTER TABLE questions MODIFY COLUMN type ENUM('essay', 'multiple_choice', 'true_false', 'final_quiz') NOT NULL");
    }

    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->unsignedBigInteger('node_id')->nullable(false)->change();
        });

        DB::statement("ALTER TABLE questions MODIFY COLUMN type ENUM('essay', 'multiple_choice', 'true_false') NOT NULL");
    }
};
