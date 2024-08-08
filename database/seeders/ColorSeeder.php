<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = "database/data/colors.json";

        // Check if file exists and is readable
        if (!File::exists($filePath) || !File::isReadable($filePath)) {
            echo "Error: File not found or not readable: $filePath\n";
            return;
        }

        $json = File::get($filePath);
        $colors = json_decode($json, true);

        // Check if json_decode was successful
        if ($colors === null) {
            echo "Error decoding JSON: " . json_last_error_msg() . "\n";
            return;
        }
        foreach ($colors as $key => $value) {
            Color::create([
                'name' => $value['name'],
                'hex' => $value['hex'],
            ]);
        }
    }
}
