<?php

namespace Database\Factories;

use App\Models\Config;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConfigFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Config::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start' => '2021-01-01 08:00:00',
            'end' => '2021-10-10 17:00:00',
            'announcement' => '<p>'.implode('</p><p>',$this->faker->paragraphs(mt_rand(1,3))).'</p>',
            'event_name' => 'Pemilihan Gubernur '.$this->faker->country(),
            'location' => $this->faker->streetAddress()
        ];
    }
}
