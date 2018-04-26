<?php

use Illuminate\Database\Seeder;
use App\Position;

class PositionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $president = new Position();
            $president->position = 'President';
            $president->save();

        $VicePresident = new Position();
            $VicePresident->position = 'Vice-President';
            $VicePresident->save();

        $secretary = new Position();
            $secretary->position = 'Secretary';
            $secretary->save();

        $treasurer = new Position();
            $treasurer->position = 'Treasurer';
            $treasurer->save();

        $auditor = new Position();
            $auditor->position = 'Auditor';
            $auditor->save();

        $pio = new Position();
            $pio->position = 'PIO';
            $pio->save();
    }
}
