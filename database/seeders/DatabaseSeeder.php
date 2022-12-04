<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Article;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       //  \App\Models\User::factory(20)->create();
      // \App\Models\Product::factory(20)->create();
       \App\Models\Flower::factory(5)->create();
       
       Article::factory(5)->create();

       $user = User::factory()->create([
        'id' => 'b74ab2e1-b51c',
        'name' => 'zahra' ,
         'email' => 'zahra@gmail.com',
         'phone' => '123456',
         'company' => 'zahra company',
         'address' => 'Et eos culpa natus quia odit dolores eveniet. Quidem blanditiis ex temporibus ut autem est voluptas et. Cumque eaque labore et qui quod qui illo temporibus. Accusantium et blanditiis dolor necessitatibus. Omnis doloremque molestias et in qui',
         'idnumber' => '258741',
         'password' => '$2a$12$jolwl5QUEcMzEovpK5UK.eQyCe4lgkvNPxfhXmtY1O53ay.5W.cj6'

      ]);
      
       Product::factory(6)->create([
        'user_id'=> $user['id']
       ]);

      $role = Role::factory()->create([
        'id'=> 'bfb36a54-a426-4543-9e9b-93235fbaedfc',
        'name' => 'admin',
        'flower'=>'crud',
        'product'=>'crud',
        'role'=>'crud',
        'allproducts'=>'crud',
        'article'=>'crud',
        'user'=>'crud'
       ]);

       $role = Role::factory()->create([
        'id'=> 'bfb36a54-a426-4543-9e9b-93235fbaedfc',
        'name' => 'seller',
        'flower'=>null,
        'product'=>'crud',
        'role'=>null,
        'allproducts'=>null,
        'article'=>null,
        'user'=>null
       ]);


       UserRole::factory()->create([
        'user_id'=> $user['id'],
        'role_id' => $role['id']
       ]);
       
     
     

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
