<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            [
                'name' => '.NET Development',
            ],
            [
                'name' => '3D Printing',
            ],
            [
                'name' => 'ASP .NET Development',
            ],
            [
                'name' => 'Accounts',
            ],
            [
                'name' => 'Agriculture and Food Engineering',
            ],
            [
                'name' => 'Analytics',
            ],
            [
                'name' => 'Android App Development',
            ],
            [
                'name' => 'Angular.js Development',
            ],
            [
                'name' => 'Animation',
            ],
            [
                'name' => 'Architecture',
            ],
            [
                'name' => 'Artificial Intelligence (AI)',
            ],
            [
                'name' => 'Backend Development',
            ],
            [
                'name' => 'Big Data',
            ],
            [
                'name' => 'BlockChain Development',
            ],
            [
                'name' => 'BlockChain Development',
            ],
        ];

        foreach ($skills as $skill){
            Skill::updateOrCreate(
                [
                    'name' => $skill['name'],
                ],
            );
        }

        Skill::whereNotIn('name', array_column($skills, 'name'))->delete();
    }
}
