<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TaskLog;

class TaskLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TaskLog::factory()->count(10)->create();
    }
}
