<?php

namespace Database\Factories;

use App\Models\AttendanceLog;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceLogFactory extends Factory
{
    protected $model = AttendanceLog::class;

    public function definition()
    {
        // Generate check_in time
        $checkInTime = $this->faker->dateTimeBetween('07:00', '09:00')->format('H:i:s');
        
        // Generate check_out time that's later than check_in
        $checkOutTime = $this->faker->dateTimeBetween('16:00', '18:00')->format('H:i:s');

        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'date' => $this->faker->date(),
            'check_in' => $checkInTime,
            'check_out' => $checkOutTime,
        ];
    }
}