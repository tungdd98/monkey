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
    }
}
class UsersTableSeeder extends Seeder {
    public function run() {
        DB::table('users')->insert([
            ['name' => 'admin', 'email' => 'admin@gmail.com', 'password' => bcrypt('123456')]
        ]);
    }
}

class SlidersTableSeeder extends Seeder {
    public function run() {
        DB::table('sliders')->insert([
            ['title' => 'Khóa học lập trình Frontend Master', 'description' => 'Lorem ipsum dolor', 'content' => 'Khóa học sẽ giúp bạn trở thành một chuyên gia Frontend với đầy đủ các kiến thức về HTML, CSS, JavaScript, Bootstrap, jQuery, chuyển PSD thành HTML ...', 'link' => 'https://zendvn.com/khoa-hoc-lap-trinh-frontend-master/', 'thumbnail' => 'img1.jpeg', 'created_by' => 'admin', 'updated_by' => 'admin', 'status' => 1],
            ['title' => 'Học lập trình trực tuyến', 'description' => 'Lorem ipsum dolor', 'content' => 'Học trực tuyến giúp bạn tiết kiệm chi phí, thời gian, cập nhật được nhiều kiến thức mới nhanh nhất và hiệu quả nhất', 'link' => 'https://zendvn.com/', 'thumbnail' => 'img2.jpeg', 'created_by' => 'admin', 'updated_by' => 'admin', 'status' => 1],
            ['title' => 'Ưu đãi học phí', 'description' => 'Lorem ipsum dolor', 'content' => 'Tổng hợp các trương trình ưu đãi học phí hàng tuần, hàng tháng đến tất các các bạn với các mức giảm đặc biệt 50%, 70%,..', 'link' => 'https://zendvn.com/uu-dai-hoc-phi-tai-zendvn/', 'thumbnail' => 'img3.jpeg', 'created_by' => 'admin', 'updated_by' => 'admin', 'status' => 1],
        ]);
    }
}