<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'iPhone 15 Pro',
                'category' => 'Смартфоны',
                'price' => 120000,
                'brand' => 'Apple',
                'image' => 'https://c.dns-shop.ru/thumb/st1/fit/500/500/e853c72719633e353b65193e301cc9e9/8517b5d57caefeef97194196729bd221e1606cafc9a005f423b21eb56314ba96.jpg.webp',
            ],
            [
                'name' => 'Samsung Galaxy S24',
                'category' => 'Смартфоны',
                'price' => 95000,
                'brand' => 'Samsung',
                'image' => 'https://c.dns-shop.ru/thumb/st4/fit/500/500/eaeba33a42d4467c49de57f334bd36a7/666e7887f02c3b8fab3972c5e3cdf21561ec814af9a9276dc5f1b2a2163b69bf.jpg.webp',
            ],
            [
                'name' => 'Sony WH-1000XM5',
                'category' => 'Наушники',
                'price' => 25000,
                'brand' => 'Sony',
                'image' => 'https://c.dns-shop.ru/thumb/st4/fit/500/500/92f5097a5043cd3526f7b4f492d02459/2df2632475190df8324dd72376786ed737facef7dc387bf5fcd76f88d5fc28ec.jpg.webp',
            ],
            [
                'name' => 'MacBook Air M2',
                'category' => 'Ноутбуки',
                'price' => 110000,
                'brand' => 'Apple',
                'image' => 'https://c.dns-shop.ru/thumb/st1/fit/500/500/318259187cb6d5356730f526caa8ae93/f90f6266dac6bf12212723b31fa2a073677c5ca54cefbc551f8d896ae1a67af5.jpg.webp',
            ],
            [
                'name' => 'Apple Watch Series 9',
                'category' => 'Часы',
                'price' => 40000,
                'brand' => 'Apple',
                'image' => 'https://c.dns-shop.ru/thumb/st1/fit/500/500/523dcc5680975cb8595118649c0ab4a8/d2e0a66b3fd2f505fa9a08426a170f381706d1046622d3deea4023da1f62a9df.jpg.webp',
            ],
            [
                'name' => 'LG OLED55C1',
                'category' => 'Телевизоры',
                'price' => 90000,
                'brand' => 'LG',
                'image' => 'https://c.dns-shop.ru/thumb/st4/fit/500/500/15a8751d34c63702d27cc555514dd872/8f587353f780a0e16074c87a2a74c8e2088f544857aee31eb69e4b5c4ca14868.jpg.webp',
            ],
            [
                'name' => 'Samsung Galaxy Tab S9',
                'category' => 'Планшеты',
                'price' => 60000,
                'brand' => 'Samsung',
                'image' => 'https://c.dns-shop.ru/thumb/st4/fit/500/500/a5ed967fc7a9239d62fbd1fc2bdb1472/84b554da4de5b2a9ad8e243c4078034878fc077fc1f4fc9040d16762c143a84e.jpg.webp',
            ],
            [
                'name' => 'Sony PlayStation 5',
                'category' => 'Игровые консоли',
                'price' => 60000,
                'brand' => 'Sony',
                'image' => 'https://c.dns-shop.ru/thumb/st1/fit/500/500/d4c2d22f316a43bae74155ee37140f1e/18a00d64a85957b578be630af5bd9d6b7a33198b8128abad151a1c2563095d6f.jpg.webp',
            ],
            [
                'name' => 'Dyson V15',
                'category' => 'Бытовая техника',
                'price' => 45000,
                'brand' => 'Dyson',
                'image' => 'https://img.mvideo.ru/Big/20084585bb.jpg',
            ],
            [
                'name' => 'Canon EOS R5',
                'category' => 'Фотоаппараты',
                'price' => 280000,
                'brand' => 'Canon',
                'image' => 'https://c.dns-shop.ru/thumb/st1/fit/500/500/90307ec969b2809ac95376dd4280eed5/981403988ed9242c9650e34cf21f2153d22ee6150e5445826916d21cad711406.jpg.webp',
            ],
            [
                'name' => 'iPad Air',
                'category' => 'Планшеты',
                'price' => 65000,
                'brand' => 'Apple',
                'image' => 'https://c.dns-shop.ru/thumb/st4/fit/500/500/386b0b6edd91ef383b20469483953975/dd2c3fcc0ef29bdbc8312d93258df0dbbc5ee30ec3483ee4e8b3772a22e22342.jpg.webp',
            ],
            [
                'name' => 'Xiaomi Redmi Note 13',
                'category' => 'Смартфоны',
                'price' => 25000,
                'brand' => 'Xiaomi',
                'image' => 'https://c.dns-shop.ru/thumb/st1/fit/500/500/dd182dc1b0265b6b9c762a76553ecb91/c535077fe172ce14b87dc57b1c9a0d3873cf76bf608832dfa58f4f928759fe0c.jpg.webp',
            ],
        ];
        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
