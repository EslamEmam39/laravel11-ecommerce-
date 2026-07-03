<?php

namespace Database\Seeders;

use App\Models\ContactUs;
use Illuminate\Database\Seeder;

class ContactUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $messages = [
            [
                'name' => 'Michael Scott',
                'email' => 'michael@dundermifflin.com',
                'phone' => '+1 (555) 019-2834',
                'message' => 'I would like to place a bulk order of your electronics for my company. Please contact me with pricing detail.',
            ],
            [
                'name' => 'Dwight Schrute',
                'email' => 'dwight@schrutefarms.com',
                'phone' => '+1 (555) 014-9821',
                'message' => 'Do you sell beet-peeling devices in your sports and outdoor category? Let me know.',
            ],
            [
                'name' => 'Pam Beesly',
                'email' => 'pam@dundermifflin.com',
                'phone' => '+1 (555) 012-3456',
                'message' => 'Hello, I received my classic leather jacket, but the size is slightly too large. Can I exchange it for a medium size?',
            ],
        ];

        foreach ($messages as $msg) {
            ContactUs::create($msg);
        }
    }
}
