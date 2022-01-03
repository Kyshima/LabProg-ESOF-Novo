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
        $position=Arr::random(array('Administrative','Computer Science','Culinary','Design','Education','Public Services','Services to the Public','Other'));
        switch($position){
            case 'Administrative': $position_sec = Arr::random(array('Secretary', 'Human Resources', 'Administrative Assistant', 'Accountant')); break;
            case 'Computer Science': $position_sec =Arr::random(array('Software Engineer', 'Hardware Technician', 'Data Scientist', 'Network Engineer','')); break;
            case 'Culinary': $position_sec = Arr::random(array('Chef', 'Sous Chef', 'Waitress')); break;
            case 'Design': $position_sec = Arr::random(array('Architect', 'Designer', 'Multimedia Designer', 'Graphics Designer')); break;
            case 'Education': $position_sec = Arr::random(array('Primary School Teacher', 'High School Teacher', 'University Teacher', 'Tutor')); break;
            case 'Public Services': $position_sec = Arr::random(array('Firefighter', 'Police', 'Doctor', 'EMT', 'Paramedic')); break;
            case 'Services to the Public': $position_sec = Arr::random(array('Public Transport Operator', 'Judge', 'Public Area Cleaner', 'Sales Assistant')); break;
            case 'Other': $position_sec = Arr::random(array('Farmer', 'Housekeeper', 'Car Cleaner', 'Gardener')); break;
        }

        $loc=Arr::random(array('Aveiro','Beja','Braga','Bragança','Castelo Branco','Coimbra','Évora','Faro','Guarda','Leiria','Lisboa','Portalegre','Porto','Santarém','Setubal','Viana do Castelo','Vila Real','Viseu'));
        switch($loc){
            case 'Viana do Castelo': case 'Braga': case 'Porto': case 'Vila Real': case 'Bragança':    $loc_sec='Norte'; break;
            case 'Aveiro': case 'Viseu': case 'Guarda': case 'Coimbra': case 'Castelo Branco': case 'Leiria': case 'Santarém': case 'Lisboa': case 'Portalegre': $loc_sec='Centro'; break;
            case 'Évora': case 'Setubal': case 'Beja': case 'Faro': $loc_sec='Sul'; break;

        }

        if($tipo!=0){//name,lastname,position,years,localization,default,img,email,password,token
            $name=Arr::random(array('Ana','Bruno','Catarina','Diogo','Eliza','Feliciano','Gabriela','Henrique','Iasmin','Jeronimo','Leonor','Matheus','Natacha','Oscar','Patricia','Rui','Sara','Tiago','Ursula','Valdemar'));
            $lastname=Arr::random(array('Silva','Santos','Ferreira','Pereira','Oliveira','Costa','Moreira','Gomes','Pinto','Marques','Cunha'));
            return [
                'type' => 1,
                'name' => $name,
                'lastName' => $lastname,
                'position_main' => $position,
                'position_sec' => $position_sec,
                'years' => rand(0,45),
                'localization_main' => $loc,
                'localization_sec' => $loc_sec,
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
                'position_main' => $position,
                'position_sec' => $position_sec,
                'years' => rand(0,10),
                'localization_main' => $loc,
                'localization_sec' => $loc_sec,
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
