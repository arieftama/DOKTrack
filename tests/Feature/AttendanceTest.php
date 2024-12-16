<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AttendanceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_check_in()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/attendance/check-in', [
            'date' => '2024-12-16',
            'check_in' => '08:00',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Check-in berhasil']);

        $this->assertDatabaseHas('attendance_logs', [
            'user_id' => $user->id,
            'date' => '2024-12-16',
            'check_in' => now()->toDateTimeString(),
        ]);
    }

    /** @test */
    public function user_can_check_out()
    {
        $user = User::factory()->create();

        // First, check in
        $this->actingAs($user)->post('/attendance/check-in', [
            'date' => '2024-12-16',
            'check_in' => '08:00',
        ]);

        // Then, check out
        $response = $this->actingAs($user)->post('/attendance/check-out', [
            'date' => '2024-12-16',
            'check_out' => '16:00',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Check-out berhasil']);

        $this->assertDatabaseHas('attendance_logs', [
            'user_id' => $user->id,
            'date' => '2024-12-16',
            'check_out' => now()->toDateTimeString(),
        ]);
    }
}