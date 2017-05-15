<?php

use App\Model\Client;
use App\Model\ShoppingList;
use Illuminate\Database\Seeder;

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

        dump($jon->getId());

        // Wish Lists
        entity(ShoppingList::class, 'wish-list', 2)->create([
            'client' => $jon
        ]);
    }
}
