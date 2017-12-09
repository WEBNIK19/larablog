<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
    	DB::table('type_users')->insert(['type'=>'admin']);

    	DB::table('users')->insert(['type_user_id'=>1,
    		'name'=>"Nikita",
    		'email'=>"elit15223@ssu.edu.ua",
    		//'email_verify'=>1,
    		//'email_token'=>"asdfhliu",
            'api_token'=>'admin1',
    		'password'=>bcrypt("admin"),
    		//'online'=>0,
    ]);
    }
}
