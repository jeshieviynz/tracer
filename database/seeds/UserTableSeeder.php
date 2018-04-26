<?php

use Illuminate\Database\Seeder;
use App\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $admin = new User();
            $admin->role_id = '1';
    		$admin->firstname = 'Jessie';
            $admin->lastname = 'Cajes';
            $admin->middlename = 'M';
            $admin->status = '1';
            $admin->username = '11-2020107 ';
            $admin->email = 'superadmin@gmail.com';
            $admin->password = bcrypt('123456789');
            $admin->save();
    }
}
