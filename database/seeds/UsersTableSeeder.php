<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'     => 'Trần Nhật Duy',
            'email'    => 'duytn.hcm@gmail.com',
            'password' => bcrypt( '@hugosafari@' ),
        ]);
        DB::table('users')->insert([
            'name'     => 'Đoàn Duy Thuần',
            'email'    => 'duythuana5@gmail.com',
            'password' => bcrypt( 'abc@123' ),
        ]);
    }
}
