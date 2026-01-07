<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('seeders/data/products.csv');

        $file = fopen($path, 'r');
        $header = fgetcsv($file); // ヘッダ行

        $rows = [];
        while (($data = fgetcsv($file)) !== false) {
            $rows[] = [
                'name'        => $data[0],
                'type'       => $data[1],
                'price'       => $data[2],
                'stock'       => $data[3],
                'storage'     => $data[4],
                'description' => $data[5] ?? null,
                'image_path'  => $data[6] ?? null,
            ];
        }

        fclose($file);

        // 大量対策：500件ずつ
        foreach (array_chunk($rows, 500) as $chunk) {
            DB::table('products')->insert($chunk);
        }
    }
}
