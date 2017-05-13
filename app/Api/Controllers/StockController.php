<?php
namespace App\Api\Controllers;

use App\Model\Product\Product;
use App\Transformers\ProductTransformer;
use LaravelDoctrine\ORM\Facades\EntityManager;

/**
 * Class StockController
 * @package App\Api\Controllers
 */
class StockController extends ApiBaseController
{
    public function get(ProductTransformer $transformer) {
        // FIXME Inject with IoC
        $repository = EntityManager::getRepository(Product::class);
        $products = $repository->findAll();

        return $this->response->collection(collect($products), $transformer);
    }
}