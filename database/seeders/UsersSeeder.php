<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersSeeder extends Seeder
{
    public function run()
    {
        // テーブルをクリアする
        User::truncate();

        // CSVファイルのパス
        $csvFile = database_path('csv/users_202406211004.csv');

        // CSVファイルを読み込み、データをデータベースに挿入
        $csvData = $this->csvToArray($csvFile);

        foreach ($csvData as $row) {
            User::create([
                'name' => $row['name'],
                'email' => $row['email'],
                'password' => Hash::make($row['password']), // bcryptでハッシュ化
            ]);
        }
    }

    // CSVファイルを配列に変換するメソッド
    private function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename)) {
            return false;
        }

        $header = null;
        $data = [];

        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (!$header) {
                    $header = $row;
                } else {
                    $data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }

        return $data;
    }
}
