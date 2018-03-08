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
        DB::table('type_users')->insert(['type'=>'user']);
        factory(App\User::class)->create([
            'type_user_id'=>1,
            'name'=>"Nikita",
            'email'=>"elit15223@ssu.edu.ua",
            //'email_verify'=>1,
            //'email_token'=>"asdfhliu",
            'api_token'=>'admin1',
            'password'=>bcrypt("admin"),
            //'online'=>0,
        ]);
        factory(App\User::class,10)->create()->each(function ($u){
            factory(App\Post::class,3)->create(['user_id'=>$u->id])->each(function ($p) {
                if($p->allow_comments == 1){
                    factory(App\Comment::class,3)->create(['post_id'=>$p->id]);
                }
            });
        });
        
    }
}
