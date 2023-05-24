<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 15; $i++){

            $randomLanguagesArray = $faker->randomElements(['Html', 'Css', 'JavaScript', 'Vue', 'Vite', 'SQL', 'Php', 'Laravel'], 2, false);
            $randomRepo = $faker->words(2);

            $project = new Project();

            $project->title = $faker->sentence(3);
            $project->description = $faker->text(400);
            $project->slug = Str::slug($project->title, '-');
            $project->thumbnail = $faker->imageUrl(360, 360, 'animals', true, 'dogs', true, 'jpg');
            $project->languages = implode(', ', $randomLanguagesArray);
            $project->year = $faker->year();
            $project->github_repo = implode('-', $randomRepo) . '-repo';

            $project->save();

        }
    }
}
