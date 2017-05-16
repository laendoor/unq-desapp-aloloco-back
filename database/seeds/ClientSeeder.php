<?php

use App\Model\Client;
use App\Model\Product\WishedProduct;
use App\Model\ShoppingList;
use Illuminate\Database\Seeder;
use LaravelDoctrine\ORM\Facades\EntityManager;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jon = entity(Client::class)->create([
            'username' => 'jon.snow',
            'email' => 'the.king.in.the.north@seven-kingdoms.org'
        ]);


        // Wish Lists
        $lists = entity(ShoppingList::class, 'wish-list', 2)->make([
            'client' => $jon,
        ]);

        $lists->each(function ($list) {
            $list->addWishedProduct(entity(WishedProduct::class)->make());
            EntityManager::persist($list);
        });

        EntityManager::flush();
    }
}
