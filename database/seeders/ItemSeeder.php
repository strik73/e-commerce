<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('items')->insert([
            [
                'no_item' => 'ITM-SUP1-240530-00001',
                'name' => 'ASUS TUF A15',
                'category_id' => 1,
                'user_id' => 1,
                'stock' => 10,
                'condition' => 'BARU',
                'price' => 15000000,
                'status' => 1,
                'description' => '<p><strong>ASUS TUF A15</strong></p><p>Processor: Intel I5-13700K</p><p>Ram: 16 GB</p><p>GPU: RTX 2080 Ti</p>',
                'image' => 'placeholder.png',
                'created_at' => \now(),
                'updated_at' => \now(),
            ],[
                'no_item' => 'ITM-SUP1-240530-00002',
                'name' => 'Logitech G102',
                'category_id' => 1,
                'user_id' => 1,
                'stock' => 3,
                'condition' => 'SECOND',
                'price' => 180000,
                'status' => 1,
                'description' => '<p>Kualitas : Second</p><p>Pemakaian 5 bulan</p>',
                'image' => 'placeholder.png',
                'created_at' => \now(),
                'updated_at' => \now(),
            ]
        ]);
    }
}
