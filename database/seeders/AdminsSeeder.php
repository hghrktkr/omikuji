<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminsSeeder extends Seeder
{
    public function run()
    {
        // テーブルをクリアする
        Admin::truncate();

        // CSVファイルのパス
        $csvFile = database_path('csv\admins_202406211028.csv');

        // CSVファイルを読み込み、データをデータベースに挿入
        $csvData = $this->csvToArray($csvFile);

        foreach ($csvData as $row) {
            Admin::create([
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
