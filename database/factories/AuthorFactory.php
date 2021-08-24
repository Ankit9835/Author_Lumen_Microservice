<?php

namespace Database\Factories;

use App\Model;
use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorFactory extends Factory
{
    protected $model = Author::class;

    public function definition(): array
    {
    	return [
    	    'name' => $this->faker->name,
            'gender' =>  $this->faker->randomElement(['male', 'female']),
            'country' => $this->faker->country
    	];
    }
}
