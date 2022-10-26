<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Anuncio;

class AnuncioFactory extends Factory
{
    /** The name of the Factory's corresponding model.*/
    protected $model = Anuncio::class;
    
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'titulo' => $this->faker->randomElement([
                        'Televisor',
                        'Coche',
                        'Radio',
                        'Libros',
                        'CDs',
                        'Sofá',
                        'Lámpara',
                        'Armario',
                        'Silla',
                        'Mesa',
                        'Nintendo',
                        'PalyStation',
                        'Bicicleta',
                        'Iphone',
                        'reloj'
                        
            ]),
            'descripcion' => $this->faker->text,
            'precio' => $this->faker->randomFloat(2, 1000, 50000),
            'imagen' => 'default.png',
            'user_id' => $this->faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20])
        ];
    }
}
