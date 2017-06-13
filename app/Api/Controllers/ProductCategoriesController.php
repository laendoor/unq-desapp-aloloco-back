<?php
namespace App\Api\Controllers;

use Dingo\Api\Http\Request;
use Dingo\Api\Http\Response;
use App\Model\Product;
use App\Model\Product\Price;
use App\Model\Product\StockedProduct;
use App\Repository\ProductRepository;
use App\Transformers\StockTransformer;
use Maatwebsite\Excel\Facades\Excel;
use Dingo\Blueprint\Annotation\Resource;
use Dingo\Blueprint\Annotation\Method\Get;
use Dingo\Blueprint\Annotation\Method\Put;

/**
 * Class ProductCategoriesController
 * @package App\Api\Controllers
 *
 * @Resource("Product Categories", uri="/product/categories")
 */
class ProductCategoriesController extends ApiBaseController
{
    /**
     * List product categories
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

}