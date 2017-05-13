<?php
namespace App\Api\Controllers;

use Dingo\Api\Http\Response;
use App\Transformers\ProductTransformer;
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
     * @var ObjectRepository
     */
    protected $repoStock;

    public function __construct(ObjectRepository $repoStock)
    {
        $this->repoStock = $repoStock;
    }

    /**
     * List products in stock
     *
     * @Get("/")
     *
     * @param ProductTransformer $transformer
     * @return Response
     */
    public function get(ProductTransformer $transformer): Response {
        $products = $this->repoStock->findAll();

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