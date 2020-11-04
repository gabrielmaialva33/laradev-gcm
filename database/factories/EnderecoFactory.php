<?php

namespace Database\Factories;

use App\Models\Bairro;
use App\Models\Endereco;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnderecoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Endereco::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $bairros = Bairro::pluck('id')->toArray();
        $codigos = Bairro::pluck('codigo_bairro')->toArray();

        return [
            'logradouro' => $this->faker->streetAddress,
            'numero' => $this->faker->randomNumber(3),
            'complemento' => $this->faker->secondaryAddress,
            'cep' => $this->faker->postcode,
            'codigo_endereco' => $this->faker->randomElement($codigos),
            'bairro_id' => $this->faker->randomElement($bairros),
        ];
    }
}
