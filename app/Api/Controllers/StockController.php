<?php
namespace App\Api\Controllers;

use App\Repository\ProductRepository;
use App\Repository\StockedProductRepository;
use App\Transformers\StockTransformer;
use Dingo\Api\Http\Response;
use Dingo\Blueprint\Annotation\Resource;
use Dingo\Blueprint\Annotation\Method\Get;
use Dingo\Blueprint\Annotation\Method\Put;
use Doctrine\Common\Persistence\ObjectRepository;

/**
 * Class StockController
 * @package App\Api\Controllers
 *
 * @Resource("Stock", uri="/stock")
 */
class StockController extends ApiBaseController
{
    /**
     * List products in stock
     *
     * @Get("/")
     *
     * @param StockedProductRepository $repoProduct
     * @param StockTransformer $transformer
     * @return Response
     */
    public function get(StockedProductRepository $repoProduct, StockTransformer $transformer): Response {
        $products = $repoProduct->findAll();

        return $this->response->collection(collect($products), $transformer);
    }

    /**
     * Receive and save new stock
     *
     * @Put("/")
     *
     * @return Response
     */
    public function store(): Response {
        return $this->response->array([
            'error' => '400',
            'description' => 'TODO'
        ]);
    }
}