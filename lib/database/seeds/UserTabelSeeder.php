<?php

use Illuminate\Database\Seeder;

class UserTabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
        	[
        		'email'=>'vuducthao2210@gmail.com',
        		'password'=>bcrypt('221097'),
        		'level'=>1
        	],
        	[

        		'email'=>'admin@gmail.com',
        		'password'=>bcrypt('123456'),
        		'level'=>1
        	]
        ];
        DB::table('vp_users')->insert($data);
    }
    //insert dữ liệu bằng cách php artisan db:seed --class=UserTableSeeder
}
