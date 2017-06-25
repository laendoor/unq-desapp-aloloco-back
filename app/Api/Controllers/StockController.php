<?php
namespace App\Api\Controllers;

use Dingo\Api\Http\Request;
use Dingo\Api\Http\Response;
use App\Model\Product;
use App\Model\Price;
use App\Model\Product\StockedProduct;
use App\Repository\ProductRepository;
use App\Transformers\StockTransformer;
use Maatwebsite\Excel\Facades\Excel;
use Dingo\Blueprint\Annotation\Resource;
use Dingo\Blueprint\Annotation\Method\Get;
use Dingo\Blueprint\Annotation\Method\Put;

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
     * @param ProductRepository $repoProduct
     * @param StockTransformer $transformer
     * @return Response
     */
    public function get(ProductRepository $repoProduct, StockTransformer $transformer): Response {
        $products = $repoProduct->findAll();

        return $this->response->collection(collect($products), $transformer);
    }

    /**
     * Receive and save new stock
     *
     * @Put("/")
     *
     * @param ProductRepository $repo
     * @param Request $request
     * @return Response
     */
    public function store(ProductRepository $repo, Request $request): Response
    {
        $file = $request->file('file');
        Excel::load($file->getPathname(), function ($reader) use ($repo) {

            collect($reader->toArray())->each(function ($product) use ($repo) {
                $product_db = $repo->findByNameAndBrand($product['nombre'], $product['marca']);
                if ($product_db) {
                    $product_db->setImage($product['imagen']);
                    $product_db->setStock(intval($product['stock']));
                    $repo->save($product_db);
                } else {
                    $product = new Product($product['nombre'], $product['marca'],
                        new Price(2), intval($product['stock']), $product['imagen']);
                    $repo->save($product);
                }

            });

        });

        return $this->response->array([
            'store' => true,
        ]);
    }
}