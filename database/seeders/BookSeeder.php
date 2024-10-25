<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Specialty;
use App\Models\Schedule;
use Illuminate\Support\Str;
class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shift = Schedule::first();
        $specialty  = Specialty::first();
        Book::create([
            'book_id' => strtoupper(Str::random(10)),
            'day' => '2024-09-26 09:00:00',
            'name' => 'Lê Phước Vinh',
            'phone' => '0787258369',
            'hour'  => '09:00:00',
            'email' => 'vinh@example.com',
            'symptoms' => 'đau họng, nhức đầu',
            'specialty_id' => $specialty->specialty_id,
            'shift_id' => $shift->shift_id
        ]);
    }
}
