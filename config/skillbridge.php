<?php

/*
|--------------------------------------------------------------------------
| SkillBridge Shared Configuration
|--------------------------------------------------------------------------
|
| This file is the single source of truth for enum-like values used across
| forms, validation rules, filters, and seeders. Import with config('skillbridge.*').
|
*/

return [

    /*
    | Project categories
    */
    'categories' => [
        'web_development'    => 'Web Development',
        'mobile_development' => 'Mobile Development',
        'design'             => 'Design & Creative',
        'writing'            => 'Writing & Translation',
        'data_science'       => 'Data Science & Analytics',
        'devops'             => 'DevOps & Cloud',
        'marketing'          => 'Marketing & SEO',
        'video_audio'        => 'Video & Audio',
        'other'              => 'Other',
    ],

    /*
    | Experience levels required for a project
    */
    'experience_levels' => [
        'junior' => 'Junior',
        'mid'    => 'Mid-level',
        'senior' => 'Senior',
    ],

    /*
    | Work arrangements
    */
    'work_arrangements' => [
        'remote'  => 'Remote',
        'onsite'  => 'On-site',
        'hybrid'  => 'Hybrid',
    ],

    /*
    | Freelancer availability options (used on freelancer profile)
    */
    'availability_options' => [
        'full_time' => 'Full-time',
        'part_time' => 'Part-time',
        'contract'  => 'Contract / Project-based',
    ],

    /*
    | Skill proficiency levels (tinyint 1–5)
    */
    'proficiency_levels' => [
        1 => 'Beginner',
        2 => 'Elementary',
        3 => 'Intermediate',
        4 => 'Advanced',
        5 => 'Expert',
    ],

    /*
    | Portfolio item types
    */
    'portfolio_types' => [
        'project'     => 'Project Sample',
        'certificate' => 'Certificate',
        'link'        => 'Work Link',
    ],

    /*
    | User roles (admin excluded from registration form by design)
    */
    'roles' => ['client', 'freelancer', 'admin'],

    'registration_roles' => ['client', 'freelancer'],
    

];

