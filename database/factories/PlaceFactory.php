<?php

namespace Database\Factories;

use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PlaceFactory extends Factory
{
    protected $model = Place::class;

    public function definition()
    {
        $name = $this->faker->unique()->city;
        return [
            'name'    => $name,
            'slug'    => Str::slug($name),
            'country' => $this->faker->country,
            'state'   => $this->faker->state,
            'city'    => $this->faker->city,
        ];
    }
}
