<?php

use Illuminate\Database\Seeder;
use App\Role;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
            $admin = new Role();
            $admin->name = 'SuperAdmin';
            $admin->save();

        	$admin = new Role();
            $admin->name = 'Admin';
            $admin->save();

            $Staff = new Role();
            $Staff->name = 'Staff';
            $Staff->save();

            $Alumni = new Role();
            $Alumni->name = 'Alumni';
            $Alumni->save();

    }
}
