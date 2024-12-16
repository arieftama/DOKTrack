<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\TaskLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskLogTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_store_task_log()
    {
        // Setup data
        $user = User::factory()->create();

        // Simulasi login
        $this->actingAs($user);

        // Panggil endpoint simpan log tugas
        $response = $this->postJson('/tasklog/store', [
            'task_name' => 'Mengirim file video',
            'description' => 'Deskripsi tugas mengirim file video',
        ]);

        // Periksa respons
        $response->assertStatus(200)
                 ->assertJson(['message' => 'Log tugas berhasil disimpan']);

        // Pastikan data tersimpan di database
        $this->assertDatabaseHas('task_logs', [
            'user_id' => $user->id,
            'task_name' => 'Mengirim file video',
            'description' => 'Deskripsi tugas mengirim file video',
        ]);
    }

    /** @test */
    public function task_log_validation()
    {
        // Setup data
        $user = User::factory()->create();

        // Simulasi login
        $this->actingAs($user);

        // Panggil endpoint simpan log tugas dengan data tidak valid
        $response = $this->postJson('/tasklog/store', [
            'task_name' => '',
            'description' => '',
        ]);

        // Periksa respons
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['task_name', 'description']);
    }
}