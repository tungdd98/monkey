<?php

use Illuminate\Database\Seeder;

class ShopTableSeeder extends Seeder
{
    public function run()
    {
        $shops = [
            [
                'title' => 'Trang chủ',
                'type' => 'Introduce',
            ],
            [
                'title' => 'Sản phẩm',
                'type' => 'Product',
                'children' => [
                    [    
                        'title' => 'Hoa quả',
                        'type' => 'Product',
                    ],
                    [    
                        'title' => 'Đồ khô',
                        'type' => 'Product',
                    ],
                ],
            ],
            [
                'title' => 'Khuyến mãi',
                'type' => 'Promotion',
            ],
            [
                'title' => 'Về chúng tôi',
                'type' => 'About',
            ],
            [
                'title' => 'Hỗ trợ',
                'type' => 'Faq',
            ],
            [
                'title' => 'Tin tức',
                'type' => 'News',
            ],
            [
                'title' => 'Liên hệ',
                'type' => 'Contact',
            ],
        ];
        foreach($shops as $shop)
        {
            \App\Models\Category::create($shop);
        }
    }
}
