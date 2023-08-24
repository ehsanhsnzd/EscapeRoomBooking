<?php

namespace Domain\Room\Seed;

use Faker\Provider\uk_UA\Text;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

         \App\Models\Room::create([
             'name' => Text::randomLetter(),
             'fee' => Text::numberBetween(10000, 99000),
             'participants' => 5,
         ]);
         \App\Models\Room::create([
             'name' => Text::randomLetter(),
             'fee' => Text::numberBetween(10000, 99000),
             'participants' => 5,
         ]);
         \App\Models\Room::create([
             'name' => Text::randomLetter(),
             'fee' => Text::numberBetween(10000, 99000),
             'participants' => 5,
         ]);
    }
}
