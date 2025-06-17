<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->company,
            'contact_project' => Project::$projectTypes[array_rand(Project::$projectTypes)],
            'user_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
