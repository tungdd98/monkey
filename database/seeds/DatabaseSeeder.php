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
        $this->call(ShopTableSeeder::class);
        $this->call(DataTypesSeeder::class);
    }
}
class UsersTableSeeder extends Seeder {
    public function run() {
        DB::table('users')->insert([
            ['name' => 'admin', 'email' => 'admin@gmail.com', 'password' => bcrypt('123456')]
        ]);
    }
}

class DataTypesSeeder extends Seeder {
    public function run() {
        DB::table('datatypes')->insert([
            ['title' => 'Sản phẩm', 'code' => 'Product'],
            ['title' => 'Tin tức', 'code' => 'News'],
            ['title' => 'HomePage', 'code' => 'Introduce'],
            ['title' => 'Hỗ trợ', 'code' => 'FAQ'],
            ['title' => 'Liên hệ', 'code' => 'Contact'],
            ['title' => 'Giới thiệu', 'code' => 'About'],
        ]);
    }
}