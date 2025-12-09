<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\WorkerContact;
use App\Models\WorkerData;
use App\Models\WorkerJobTitle;
use App\Models\WorkerSchedule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Worker>
 */
class WorkerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'worker_data_id'     => WorkerData::factory(),
            'worker_contact_id'  => WorkerContact::factory(),
            'schedule_id'   => WorkerSchedule::factory(),
            'job_title_id'   => WorkerJobTitle::factory(),
            'user_id' => User::factory()
        ];
    }
}
