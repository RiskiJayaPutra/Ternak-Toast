<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Admin
        User::create([
            'name' => 'Admin Ternak Toast',
            'email' => 'admin@ternaktoast.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'phone' => '081234567890',
        ]);

        // 2. Create Customer
        User::create([
            'name' => 'Budi Customer',
            'email' => 'budi@example.com',
            'password' => bcrypt('password'),
            'role' => 'customer',
            'phone' => '089876543210',
        ]);

        // 3. Create Categories
        $asin = Category::create(['name' => 'Toast Asin', 'slug' => Str::slug('Toast Asin')]);
        $manis = Category::create(['name' => 'Toast Manis', 'slug' => Str::slug('Toast Manis')]);
        $minuman = Category::create(['name' => 'Minuman', 'slug' => Str::slug('Minuman')]);

        // 4. Create Products
        Product::create([
            'category_id' => $asin->id,
            'name' => 'Beef BBQ Toast',
            'slug' => Str::slug('Beef BBQ Toast'),
            'description' => 'Roti panggang isi daging sapi lada hitam dengan saus BBQ spesial.',
            'price' => 25000,
            'stock' => 50,
            'image' => 'instagram post 10.png',
        ]);

        Product::create([
            'category_id' => $asin->id,
            'name' => 'Spicy Tuna Toast',
            'slug' => Str::slug('Spicy Tuna Toast'),
            'description' => 'Roti panggang isi ikan tuna pedas dengan mayones.',
            'price' => 22000,
            'stock' => 50,
            'image' => '1.png',
        ]);

        Product::create([
            'category_id' => $manis->id,
            'name' => 'Choco Crunchy Toast',
            'slug' => Str::slug('Choco Crunchy Toast'),
            'description' => 'Roti panggang manis dengan selai cokelat tebal dan sensasi renyah.',
            'price' => 18000,
            'stock' => 50,
            'image' => '2.png',
        ]);

        Product::create([
            'category_id' => $minuman->id,
            'name' => 'Es Kopi Susu Aren',
            'slug' => Str::slug('Es Kopi Susu Aren'),
            'description' => 'Kopi susu dengan manisnya gula aren asli.',
            'price' => 15000,
            'stock' => 100,
            'image' => '3.png',
        ]);
    }
}
