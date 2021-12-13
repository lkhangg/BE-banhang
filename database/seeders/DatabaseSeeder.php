<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // seed product
        DB::table('products')->insert([
            'name'=>'Nike Air Max 1 Ultra Essential',
            'price'=>3390000,
            'type'=>'Gym & Training',
            'imgURL'=>'trang_air-max-1-ultra-essential-shoe_1_large.jpg',
            'total_product'=>5
        ]);
        DB::table('products')->insert([
            'name'=>'Kobe Xi',
            'price'=>4590000,
            'type'=>'Gym & Training',
            'imgURL'=>'trang_kobe-xi-basketball-shoe_1_large.jpg',
            'total_product'=>20
        ]);
        DB::table('products')->insert([
            'name'=>'Nike Train Speed 4',
            'price'=>3090000,
            'type'=>'Running',
            'imgURL'=>'do_train-speed-4-training-shoe_1_large.jpg',
            'total_product'=>20
        ]);
        DB::table('products')->insert([
            'name'=>'Nike Free Train Versatility',
            'price'=>3090000,
            'type'=>'Running',
            'imgURL'=>'xanh-la_free-train-versatility-training-shoe_1_large.jpg',
            'total_product'=>20
        ]);
        //seed detail_product
        DB::table('product_details')->insert([
            'product_id'=>1,
            'color'=>'Vàng',
            'quantity'=>20,
            'size'=>'40',
        ]);
       
        // db seed image img
        DB::table('images')->insert([
            'product_id'=>1,
            'image'=>'details_1_1.jpg',
        ]);
        DB::table('images')->insert([
            'product_id'=>1,
            'image'=>'details_1_2.jpg',
        ]);
        DB::table('images')->insert([
            'product_id'=>1,
            'image'=>'details_1_3.jpg',
        ]);
        // db seed employee
        DB::table('employees')->insert([
            'name'=>'admin1',
            'gender'=>'male',
            'birthday'=>'2000/01/01',
            'phone'=>'19009832',
            'email'=>'admin1@gmail.com',
            'user_name'=>'admin_toan',
            'address'=>'Việt Nam',
            'password'=>'admin',
        ]);
        DB::table('employees')->insert([
            'name'=>'admin2',
            'gender'=>'female',
            'birthday'=>'2000/01/01',
            'phone'=>'190099932',
            'email'=>'admin2@gmail.com',
            'user_name'=>'admin_hang',
            'address'=>'Việt Nam',
            'password'=>'admin',
        ]);
        DB::table('employees')->insert([
            'name'=>'users',
            'gender'=>'male',
            'birthday'=>'2000/01/01',
            'phone'=>'190099090',
            'email'=>'user@gmail.com',
            'user_name'=>'user_nhanvien',
            'address'=>'Việt Nam',
            'password'=>'user',
        ]);
        //db seed customer
        DB::table('customers')->insert([
            'name'=>'Khách hàng',
            'phone'=>'19009832',
            'email'=>'customer1@gmail.com',
            'address'=>'Việt Nam',
            'password'=>'customer',
        ]);
    }
}
