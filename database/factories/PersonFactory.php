<?php

namespace Database\Factories;

use App\Models\Person;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'contact_person' => $this->faker->name(),
            'user_id' => $this->faker->numberBetween(1, 10),
            'company_id' => Company::inRandomOrder()->first()->id,
        ];
    }
}
