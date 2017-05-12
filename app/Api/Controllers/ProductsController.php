<?php
namespace App\Api\Controllers;

use App\Model\Product\Product;
use App\Transformers\ProductTransformer;
use LaravelDoctrine\ORM\Facades\EntityManager;

/**
 * Class ProductsController
 * @package App\Api\Controllers
 */
class ProductsController extends ApiBaseController
{
    public function index(ProductTransformer $transformer) {
        // FIXME Inject with IoC
        $repository = EntityManager::getRepository(Product::class);
        $products = $repository->findAll();

        return $this->response->collection(collect($products), $transformer);
    }
}