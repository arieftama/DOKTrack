<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('task_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users'); // foreign key ke tabel users
            $table->string('task_name');
            $table->text('description');
            $table->enum('status', ['pending', 'in_progress', 'complete'])->default('pending');
            $table->date('date');
            $table->timestamp('timestamp')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_logs');
    }
};
