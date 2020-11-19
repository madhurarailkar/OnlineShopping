<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
    	$admin = new User();
    	$admin->name = 'admin';
    	$admin->email = 'admin@gmail.com';
        $admin->password = bcrypt('admin123');
        $admin->is_admin=1;
        $admin->address='XYZ';
        $admin->mobile='9865632365';
        $admin->save();
    }
}
