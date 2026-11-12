<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            // Web
            ['name' => 'PHP',              'category' => 'Web Development'],
            ['name' => 'Laravel',          'category' => 'Web Development'],
            ['name' => 'JavaScript',       'category' => 'Web Development'],
            ['name' => 'TypeScript',       'category' => 'Web Development'],
            ['name' => 'Vue.js',           'category' => 'Web Development'],
            ['name' => 'React',            'category' => 'Web Development'],
            ['name' => 'Tailwind CSS',     'category' => 'Web Development'],
            ['name' => 'HTML & CSS',       'category' => 'Web Development'],
            // Data
            ['name' => 'Python',           'category' => 'Data Science & Analytics'],
            ['name' => 'MySQL',            'category' => 'Data Science & Analytics'],
            ['name' => 'PostgreSQL',       'category' => 'Data Science & Analytics'],
            // DevOps
            ['name' => 'Docker',           'category' => 'DevOps & Cloud'],
            ['name' => 'Linux / Bash',     'category' => 'DevOps & Cloud'],
            // Design
            ['name' => 'Figma',            'category' => 'Design & Creative'],
            ['name' => 'UI/UX Design',     'category' => 'Design & Creative'],
        ];

        foreach ($skills as $skill) {
            Skill::firstOrCreate(['name' => $skill['name']], ['category' => $skill['category']]);
        }
    }
}

