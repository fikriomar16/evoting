<?php

namespace Database\Factories;

use App\Models\Candidate;
use Illuminate\Database\Eloquent\Factories\Factory;

class CandidateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Candidate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_calon' => $this->faker->unique()->nik(),
            'nama_calon' => $this->faker->unique()->name(),
            'id_wakil_calon' => $this->faker->unique()->nik(),
            'nama_wakil_calon' => $this->faker->unique()->name(),
            'visi' => '<p>'.implode('</p><p>',$this->faker->sentences(mt_rand(1,3))).'</p>',
            'misi' => '<p>'.implode('</p><p>',$this->faker->sentences(mt_rand(4,7))).'</p>',
            'foto' => 'default.png'
        ];
    }
}
