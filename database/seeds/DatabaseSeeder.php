<?php

use App\Tag;
use App\Role;
use App\User;
use App\Image;
use App\Review;
use App\Ticket;
use App\Address;
use App\Product;
use App\Category;
use App\role_user;
use App\TicketType;
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
        // factory(Address::class,200)->create();
        // factory(User::class,200)->create();
        // factory(User::class)->states('my-user')->create();
        // factory(Product::class,500)->create();
        // factory(Review::class,120)->create();
        // factory(Image::class,1000)->create();
        // factory(Category::class,100)->create();
        // factory(Tag::class,80)->create();
        // factory(Role::class,8)->create();
        // factory(Ticket::class,20)->create();
        // factory(role_user::class,200)->create();
        factory(TicketType::class,30)->create();
    }
}
