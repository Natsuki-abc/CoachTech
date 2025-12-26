<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Category::count() > 0) {
            $this->command->info('Categories already seeded!');
            return;
        }

        $categories = [
            '商品のお届けについて',
            '商品の交換について',
            '商品トラブル',
            'ショップへのお問い合わせ',
            'その他',
        ];

        $now = now();
        $data = [];
        foreach ($categories as $content) {
            $data[] = [
                'id' => Str::uuid(),
                'content' => $content,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        Category::insert($data);
    }
}
