<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\CertificationUser;
use App\Models\Projects;
use App\Models\UserProject;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Department::factory(5)->sequence(
            ['name' => 'ECS'],
            ['name' => 'Ruby+'],
            ['name' => 'Lowcode+'],
            ['name' => 'UIT'],
            ['name' => 'QM'],
        )->create([]);
        \App\Models\Certification::factory(5)->sequence(
            [
                'name' => 'Google Certified Professional Cloud Architect',
                'note' => 'dien toan dam may',
                'granted' => 'Google',
            ],
            [
                'name' => 'AWS Certified Solutions Architect',
                'note' => 'bao mat',
                'granted' => 'AWS',
            ],
            [
                'name' => 'Certified Risk and Information Systems Control',
                'note' => 'an ninh mang',
                'granted' => 'ISACA',
            ],
            [
                'name' => 'Project Management Professiona',
                'note' => 'quan ly du an',
                'granted' => 'Viện Quản lý Dự án',
            ],
            [
                'name' => 'Certified Information Systems Security Professional',
                'note' => 'bao mat',
                'granted' => 'ISC',
            ],
            [
                'name' => 'Certified Information Systems Auditor',
                'note' => 'bao mat',
                'granted' => 'ISACA',
            ],

        )->create([]);
        $this->call([
            UserSeeder::class,
        ]);
        CertificationUser::factory(10)->create();
        Projects::factory(20)->create();
        UserProject::factory(20)->create();
    }
}
