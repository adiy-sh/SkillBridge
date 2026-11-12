<?php

namespace Database\Seeders;

use App\Models\FreelancerProfile;
use App\Models\PortfolioItem;
use App\Models\Skill;
use App\Models\SkillEndorsement;
use App\Models\User;
use App\Models\UserSkill;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FreelancerSeeder extends Seeder
{
    public function run(): void
    {
        $php      = Skill::where('name', 'PHP')->first();
        $laravel  = Skill::where('name', 'Laravel')->first();
        $vue      = Skill::where('name', 'Vue.js')->first();
        $tailwind = Skill::where('name', 'Tailwind CSS')->first();
        $react    = Skill::where('name', 'React')->first();
        $js       = Skill::where('name', 'JavaScript')->first();
        $figma    = Skill::where('name', 'Figma')->first();
        $uiux     = Skill::where('name', 'UI/UX Design')->first();

        // ── Freelancer 1 ──────────────────────────────────────────────────────
        $f1 = User::firstOrCreate(
            ['email' => 'freelancer1@example.com'],
            [
                'name'     => 'Alice Dev',
                'password' => Hash::make('password'),
                'role'     => 'freelancer',
            ]
        );

        $profile1 = FreelancerProfile::firstOrCreate(
            ['user_id' => $f1->id],
            [
                'headline'    => 'Full-Stack Laravel & Vue Developer',
                'bio'         => 'I build modern web applications with Laravel and Vue.js. 5+ years of experience delivering clean, well-tested code.',
                'hourly_rate' => 65.00,
                'availability'=> 'full_time',
            ]
        );

        // User skills for f1
        $us1_php     = UserSkill::firstOrCreate(['user_id' => $f1->id, 'skill_id' => $php->id],     ['proficiency' => 5]);
        $us1_laravel = UserSkill::firstOrCreate(['user_id' => $f1->id, 'skill_id' => $laravel->id], ['proficiency' => 5]);
        $us1_vue     = UserSkill::firstOrCreate(['user_id' => $f1->id, 'skill_id' => $vue->id],     ['proficiency' => 4]);
        $us1_tail    = UserSkill::firstOrCreate(['user_id' => $f1->id, 'skill_id' => $tailwind->id],['proficiency' => 4]);

        // Portfolio items for f1
        PortfolioItem::firstOrCreate(
            ['freelancer_profile_id' => $profile1->id, 'title' => 'SkillBridge Platform'],
            [
                'type'        => 'project',
                'description' => 'Freelancing marketplace built with Laravel, Blade and Tailwind.',
                'url'         => 'https://github.com/example/skillbridge',
                'sort_order'  => 0,
            ]
        );
        PortfolioItem::firstOrCreate(
            ['freelancer_profile_id' => $profile1->id, 'title' => 'Laravel Certified Developer'],
            [
                'type'        => 'certificate',
                'description' => 'Official Laravel certification — 2024.',
                'sort_order'  => 1,
            ]
        );
        PortfolioItem::firstOrCreate(
            ['freelancer_profile_id' => $profile1->id, 'title' => 'Open-Source Vue Component Library'],
            [
                'type'        => 'link',
                'description' => 'A collection of accessible, Tailwind-styled Vue 3 components.',
                'url'         => 'https://github.com/example/vue-lib',
                'sort_order'  => 2,
            ]
        );

        // ── Freelancer 2 ──────────────────────────────────────────────────────
        $f2 = User::firstOrCreate(
            ['email' => 'freelancer2@example.com'],
            [
                'name'     => 'Bob Design',
                'password' => Hash::make('password'),
                'role'     => 'freelancer',
            ]
        );

        $profile2 = FreelancerProfile::firstOrCreate(
            ['user_id' => $f2->id],
            [
                'headline'    => 'UI/UX Designer & React Developer',
                'bio'         => 'I craft beautiful, user-centred interfaces and bring them to life with React.',
                'hourly_rate' => 55.00,
                'availability'=> 'part_time',
            ]
        );

        $us2_react = UserSkill::firstOrCreate(['user_id' => $f2->id, 'skill_id' => $react->id], ['proficiency' => 5]);
        $us2_js    = UserSkill::firstOrCreate(['user_id' => $f2->id, 'skill_id' => $js->id],    ['proficiency' => 4]);
        $us2_figma = UserSkill::firstOrCreate(['user_id' => $f2->id, 'skill_id' => $figma->id], ['proficiency' => 5]);
        $us2_uiux  = UserSkill::firstOrCreate(['user_id' => $f2->id, 'skill_id' => $uiux->id],  ['proficiency' => 5]);

        PortfolioItem::firstOrCreate(
            ['freelancer_profile_id' => $profile2->id, 'title' => 'E-Commerce Dashboard Redesign'],
            [
                'type'        => 'project',
                'description' => 'Complete UI redesign for a Shopify store — 40% conversion lift.',
                'sort_order'  => 0,
            ]
        );
        PortfolioItem::firstOrCreate(
            ['freelancer_profile_id' => $profile2->id, 'title' => 'NN/g UX Certification'],
            [
                'type'        => 'certificate',
                'description' => 'Nielsen Norman Group UX Certificate — 2023.',
                'sort_order'  => 1,
            ]
        );
        PortfolioItem::firstOrCreate(
            ['freelancer_profile_id' => $profile2->id, 'title' => 'Dribbble Portfolio'],
            [
                'type'        => 'link',
                'description' => 'Selected UI design work.',
                'url'         => 'https://dribbble.com/example',
                'sort_order'  => 2,
            ]
        );

        // ── Cross-endorsements (client endorses f1 skills; f2 endorses f1) ───
        $client = User::where('email', 'client@example.com')->first();
        if ($client) {
            SkillEndorsement::firstOrCreate(
                ['user_skill_id' => $us1_php->id, 'endorsed_by_id' => $client->id],
                ['note' => 'Alice wrote some of the best PHP I have reviewed.']
            );
            SkillEndorsement::firstOrCreate(
                ['user_skill_id' => $us1_laravel->id, 'endorsed_by_id' => $client->id],
                ['note' => 'Delivered a solid Laravel app on time.']
            );
        }

        SkillEndorsement::firstOrCreate(
            ['user_skill_id' => $us1_vue->id, 'endorsed_by_id' => $f2->id],
            ['note' => 'Great Vue components.']
        );

        SkillEndorsement::firstOrCreate(
            ['user_skill_id' => $us2_figma->id, 'endorsed_by_id' => $f1->id],
            ['note' => 'Bob's Figma files are incredibly well organised.']
        );
    }
}

