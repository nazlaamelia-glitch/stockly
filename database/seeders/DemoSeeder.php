<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        // Akun admin dan user contoh
        $this->makeUser('Admin', 'admin@stockly.test', 'admin12345', 'admin');
        $this->makeUser('Test User', 'test@example.com', 'password123', 'user');

        // Kategori contoh
        $elektronik = Category::firstOrCreate(
            ['name' => 'Elektronik'],
            ['description' => 'Perangkat dan aksesoris elektronik']
        );
        $makanan = Category::firstOrCreate(
            ['name' => 'Makanan'],
            ['description' => 'Makanan dan minuman kemasan']
        );
        $alatTulis = Category::firstOrCreate(
            ['name' => 'Alat Tulis'],
            ['description' => 'Perlengkapan menulis dan kantor']
        );

        // Produk contoh (sebagian sengaja stok rendah)
        $products = [
            [$elektronik, 'Mouse Wireless', 3, 85000],
            [$elektronik, 'Keyboard Mekanik', 12, 350000],
            [$elektronik, 'Flashdisk 32GB', 5, 60000],
            [$makanan, 'Biskuit Kelapa', 40, 12000],
            [$makanan, 'Teh Botol', 2, 5000],
            [$alatTulis, 'Pulpen Hitam', 100, 3500],
            [$alatTulis, 'Buku Tulis A5', 25, 8000],
        ];

        foreach ($products as [$category, $name, $stock, $price]) {
            Product::updateOrCreate(
                ['name' => $name],
                [
                    'category_id' => $category->id,
                    'description' => 'Produk contoh: ' . $name,
                    'stock' => $stock,
                    'price' => $price,
                ]
            );
        }
    }

    private function makeUser(string $name, string $email, string $password, string $role): void
    {
        $user = User::firstOrNew(['email' => $email]);

        // role tidak ada di $fillable (sengaja, demi keamanan), jadi diisi dengan forceFill
        $user->forceFill([
            'name' => $name,
            'password' => $password,
            'role' => $role,
        ])->save();
    }
}