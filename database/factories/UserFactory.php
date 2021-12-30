<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $tipo=rand(0,5);
        if($tipo!=0){//name,lastname,position,years,localization,default,img,email,password,token
            $name=Arr::random(array('Ana','Bruno','Catarina','Diogo','Eliza','Feliciano','Gabriela','Henrique','Iasmin','Jeronimo','Leonor','Matheus','Natacha','Oscar','Patricia','Rui','Sara','Tiago','Ursula','Valdemar'));
            $lastname=Arr::random(array('Silva','Santos','Ferreira','Pereira','Oliveira','Costa','Moreira','Gomes','Pinto','Marques','Cunha'));
            return [
                'type' => 1,
                'name' => $name,
                'lastName' => $lastname,
                'position' => Arr::random(array('Designer','Cozinheiro','Audio Producer','Produtor Audio-Visual','Engenheiro Software')),
                'years' => rand(0,45),
                'localization' =>Arr::random(array('Viana do Castelo','Braga','Porto','Vila Real','Bragança','Aveiro','Viseu','Guarda','Coimbra','Castelo Branco','Leiria','Santarém','Lisboa','Portalegre','Évora','Setubal','Beja','Faro')),
                'email' => $name.Arr::random(array('.','-','_','')).$lastname.rand(1940,2010).'@'.Str::random(5).'.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password             
                'default' => 1,
                'img' => 'default.jpg',
                'remember_token' => Str::random(10),
            ];
        }else{//name,position,years,localization,email,password,token
            return [
                'type' => 0,
                'name' => $this->faker->company(),
                'position' => Arr::random(array('Designer','Cozinheiro','Audio Producer','Produtor Audio-Visual','Engenheiro Software')),
                'years' => rand(0,10),
                'localization' =>Arr::random(array('Viana do Castelo','Braga','Porto','Vila Real','Bragança','Aveiro','Viseu','Guarda','Coimbra','Castelo Branco','Leiria','Santarém','Lisboa','Portalegre','Évora','Setubal','Beja','Faro')),
                'email' => $this->faker->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password             
                'remember_token' => Str::random(10),
            ];
        }        
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
