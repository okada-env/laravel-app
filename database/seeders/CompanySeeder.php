<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Factories\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies') -> insert([
            [
                'name' => '株式会社テスト1',
                'email' => 'test1@example.come'
            ],
            [
                'name' => '株式会社テスト2',
                'email' => 'test2@example.come'
            ],
            [
                'name' => '株式会社テスト3',
                'email' => 'test3@example.come'
            ]
            ]);
    }
}
