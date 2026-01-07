<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('seeders/data/Items.csv');

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

        DB::table('items')->insert($rows);


    }
}
