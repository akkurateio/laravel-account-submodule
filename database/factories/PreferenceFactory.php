<?php

namespace Akkurate\LaravelAccountSubmodule\Database\Factories;

use Akkurate\LaravelAccountSubmodule\Models\Preference;
use Illuminate\Database\Eloquent\Factories\Factory;

class PreferenceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Preference::class;

    public function definition()
    {
        return [
            'preferenceable_type' => 'Akkurate\LaravelAccountSubmodule\Models\Account',
            'preferenceable_id' => 1,
            'target' => $this->faker->randomElement(['both', 'b2c', 'b2b']),
            'pagination' => $this->faker->numberBetween(1, 500),
        ];
    }
}
