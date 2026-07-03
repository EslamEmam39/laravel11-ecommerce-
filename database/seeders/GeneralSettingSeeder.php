<?php

namespace Database\Seeders;

use App\Models\GeneralSetting;
use Illuminate\Database\Seeder;

class GeneralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GeneralSetting::firstOrCreate(
            ['email' => 'support@ecommerce.com'],
            [
                'name' => 'Antigravity E-Commerce',
                'phone' => '+1 (555) 123-4567',
                'address' => '123 Tech Street, Silicon Valley, CA, USA',
                'logo' => 'settings/logo.png',
            ]
        );
    }
}
