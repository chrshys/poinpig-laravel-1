<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Team::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $teamType = $this->faker->randomElement(['family', 'classroom']);

        return [
            'name' => $this->faker->company(),
            'user_id' => User::factory(),
            'personal_team' => true,
            'team_type' => $teamType,
            'description' => $this->faker->paragraph(),
            'educational_grade' => $teamType === 'classroom' ? $this->faker->randomElement(['K', '1st', '2nd', '3rd', '4th', '5th', '6th', '7th', '8th', '9th', '10th', '11th', '12th']) : null,
        ];
    }
}
