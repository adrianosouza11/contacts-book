<?php

namespace Database\Seeders;

use App\Models\ContactBook;
use Illuminate\Database\Seeder;

class ContactBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactBook::factory()->count(10)->create();
    }
}
