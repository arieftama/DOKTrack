<?php

namespace Database\Factories;

use App\Models\TaskLog;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskLogFactory extends Factory
{
    protected $model = TaskLog::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'task_name' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'complete']), // changed 'completed' to 'complete'
            'date' => $this->faker->date,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}