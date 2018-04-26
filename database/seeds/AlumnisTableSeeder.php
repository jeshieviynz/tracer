<?php

use Illuminate\Database\Seeder;
use App\alumni;

class AlumnisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $alumni = new alumni(); 
            $alumni->id = '1';
    		$alumni->Alumni_ID_Number = '14-2020108';
            $alumni->First_Name = 'Jessie Vincent';
            $alumni->Last_Name = 'Cajes';
            $alumni->Middle_Name = '';
            $alumni->Address = 'Cebu City';
            $alumni->Email = 'jessiev@gmail.com';
            $alumni->Birthdate = '1991/11/22';
            $alumni->Home_Phone = '238 - 2380';
            $alumni->Mobile_Phone = '9154568013';
            $alumni->Course = 'BSBA - OM';
            $alumni->Year_Graduated = '2017';
            $alumni->save();
    }
}
