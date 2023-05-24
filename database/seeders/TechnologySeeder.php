<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $technologies = ['VS Code', 'Figma', 'HTML', 'CSS', 'Sass', 'Scss', 'JS', 'Vue', 'Bootstrap', 'PHP', 'MySQL', 'Laravel'];

        foreach($technologies as $technology){

            $newTechnology = new Technology();

            $newTechnology->name = $technology;
            $newTechnology->color = $faker->hexColor();
            $newTechnology->slug = Str::slug($newTechnology->name, '-');

            $newTechnology->save();
        }
    }
}
