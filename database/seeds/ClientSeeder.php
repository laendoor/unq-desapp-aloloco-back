<?php

use App\Model\Client;
use App\Model\Product\Price;
use App\Model\Product\WishedProduct;
use App\Model\ShoppingList;
use App\Repository\DoctrineProductRepository;
use App\Repository\ProductRepository;
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
        $cumple = entity(ShoppingList::class, 'wish-list')->make([
            'client' => $jon,
            'name'   => 'Cumpleaños'
        ]);

        $navidad = entity(ShoppingList::class, 'wish-list')->make([
            'client' => $jon,
            'name'   => 'Navidad'
        ]);

        $despedida = entity(ShoppingList::class, 'wish-list')->make([
            'client' => $jon,
            'name'   => 'Despedida de Soltero'
        ]);

        $asado = entity(ShoppingList::class, 'wish-list')->create([
            'client' => $jon,
            'name'   => 'Asado del Domingo'
        ]);

        // Asado
        $this->addTo('Cerveza', 'Quilmes', 10, $asado);
        $this->addTo('Papas Fritas', 'Lays', 10, $asado);
        $this->addTo('Azúcar', 'Chango', 1, $asado);
        $this->addTo('Vino Tinto', 'Uvita', 12, $asado);

        // Despedida
        $this->addTo('Cerveza', 'Quilmes', 12, $despedida);
        $this->addTo('Papas Fritas', 'Lays', 11, $despedida);
        $this->addTo('Tapa de Tarta', 'La Salteña', 2, $despedida);
        $this->addTo('Vino Tinto', 'Uvita', 11, $despedida);

        // Navidad
        $this->addTo('Papas Fritas', 'Lays', 11, $navidad);
        $this->addTo('Aceite', 'Natura', 1, $navidad);
        $this->addTo('Porotos', 'Arcor', 1, $navidad);
        $this->addTo('Algodón', 'Estrella', 3, $navidad);
        $this->addTo('Jabón', 'Suave', 1, $navidad);

        // Cumpleaños
        $this->addTo('Papas Fritas', 'Lays', 11, $cumple);
        $this->addTo('Aceite', 'Natura', 1, $cumple);
        $this->addTo('Jabón en Polvo', 'Zorro', 1, $cumple);
        $this->addTo('Leche', 'Sancor', 4, $cumple);

    }

    protected function addTo(string $name, string $brand, $quantity, $list)
    {
        $repo = resolve(ProductRepository::class);

        $product = $repo->findByNameAndBrand($name, $brand);
        $product = new WishedProduct($product, $quantity);

        $list->addWishedProduct($product);

        EntityManager::persist($list);
        EntityManager::flush();
    }
}
