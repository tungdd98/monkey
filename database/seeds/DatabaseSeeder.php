<?php

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
        $this->call(UsersTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
    }
}
class UsersTableSeeder extends Seeder {
    public function run() {
        DB::table('users')->insert([
            ['name' => 'admin', 'email' => 'admin@gmail.com', 'password' => bcrypt('123456')]
        ]);
    }
}
class ProductsTableSeeder extends Seeder {
    public function run() {
        DB::table('products')->insert([
            ['title' => 'Hồng trà sữa', 'description' => 'Bình thường', 'content' => 'Tầm thường'],
            ['title' => 'Trà vải', 'description' => 'Tạm được', 'content' => 'Tầm thường'],
            ['title' => 'Trà sữa chân trâu đường đen', 'description' => 'Kinh dị', 'content' => 'Tầm thường'],
            ['title' => 'Trà quất', 'description' => 'Ngon', 'content' => 'Tầm thường'],
        ]);
    }
}