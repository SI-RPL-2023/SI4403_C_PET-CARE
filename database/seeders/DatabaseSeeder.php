<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        User::create([
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        Category::create([
            'name' => 'Dry Food',
            'slug' => 'dry-food'
        ]);

        Category::create([
            'name' => 'Wet Food',
            'slug' => 'wet-food'
        ]);

        Product::create([
            'category_id' => 1,
            'name' => 'Whiskas',
            'weight' => '1.2kg',
            'slug' => 'whiskas-1.2kg',
            'stock' => 6,
            'price' => 70000,
            'description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Magni nemo aperiam molestiae eaque ab odio ipsam ut, maiores, veritatis deleniti ducimus necessitatibus possimus doloribus voluptatum labore modi dolore voluptatem architecto tempore corrupti alias ipsum odit? Eius culpa, dolorem asperiores deleniti ipsa cum dolor incidunt quas earum reiciendis rem tempora distinctio laboriosam minus, quae suscipit perferendis officiis rerum recusandae beatae ex corrupti laborum id deserunt! Placeat dolore qui obcaecati assumenda, ut optio accusamus officia ex fuga, excepturi autem velit? Modi, autem.',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'image' => 'tes'
        ]);

        Product::create([
            'category_id' => 2,
            'name' => 'Royal Canin',
            'weight' => '150gr',
            'slug' => 'royal-canin-150gr',
            'stock' => 8,
            'price' => 50000,
            'description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Magni nemo aperiam molestiae eaque ab odio ipsam ut, maiores, veritatis deleniti ducimus necessitatibus possimus doloribus voluptatum labore modi dolore voluptatem architecto tempore corrupti alias ipsum odit? Eius culpa, dolorem asperiores deleniti ipsa cum dolor incidunt quas earum reiciendis rem tempora distinctio laboriosam minus, quae suscipit perferendis officiis rerum recusandae beatae ex corrupti laborum id deserunt! Placeat dolore qui obcaecati assumenda, ut optio accusamus officia ex fuga, excepturi autem velit? Modi, autem.',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'image' => 'tes'
        ]);

        Product::create([
            'category_id' => 2,
            'name' => 'Pedigree',
            'weight' => '350gr',
            'slug' => 'pedigree-350gr',
            'stock' => 11,
            'price' => 65000,
            'description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Magni nemo aperiam molestiae eaque ab odio ipsam ut, maiores, veritatis deleniti ducimus necessitatibus possimus doloribus voluptatum labore modi dolore voluptatem architecto tempore corrupti alias ipsum odit? Eius culpa, dolorem asperiores deleniti ipsa cum dolor incidunt quas earum reiciendis rem tempora distinctio laboriosam minus, quae suscipit perferendis officiis rerum recusandae beatae ex corrupti laborum id deserunt! Placeat dolore qui obcaecati assumenda, ut optio accusamus officia ex fuga, excepturi autem velit? Modi, autem.',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'image' => 'tes'
        ]);
    }
}
