<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\User;

class ItemsSeeder extends Seeder
{
    public function run(): void
    {
        $csvFile = database_path('csv/items_202506201455.csv'); // CSVファイルパス
        $rows = array_map('str_getcsv', file($csvFile));
        $header = array_shift($rows);

        foreach ($rows as $row) {
            $data = array_combine($header, $row);
            if (empty($data['email'])) continue;

            // メールからユーザー取得
            $user = User::where('email', $data['email'])->first();

            if ($user) {
                Item::create([
                    'email' => $data['email'],
                    'rank_name' => $data['rank_name'],
                    'quantity' => (int)$data['quantity'],
                    'created_at' => $data['created_at'] ?: now(),
                    'updated_at' => $data['updated_at'] ?: now(),
                ]);
            }
        }
    }
}
