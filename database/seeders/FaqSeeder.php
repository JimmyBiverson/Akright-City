<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            ['question' => 'How do I pay my association dues?', 'answer' => 'Dues can be paid via mobile money or bank transfer. Contact the Treasurer for details.', 'sort_order' => 1],
            ['question' => 'How do I report a security incident?', 'answer' => 'Please contact the Security Minister or your Village Chairperson immediately.', 'sort_order' => 2],
            ['question' => 'How can I join a committee?', 'answer' => 'We welcome volunteers! Reach out to any Executive Committee member to express your interest.', 'sort_order' => 3],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
