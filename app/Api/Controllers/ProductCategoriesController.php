<?php
namespace App\Api\Controllers;

use App\Model\Product\StockedProduct;
use App\Repository\ProductCategoryRepository;
use App\Transformers\ProductCategoryTransformer;
use Dingo\Api\Http\Response;
use Dingo\Blueprint\Annotation\Resource;
use Dingo\Blueprint\Annotation\Method\Get;

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
     * @param ProductCategoryRepository $repo
     * @param ProductCategoryTransformer $transformer
     * @return Response
     */
    public function index(ProductCategoryRepository $repo, ProductCategoryTransformer $transformer): Response {
        $categories = $repo->findAll();

        return $this->response->collection(collect($categories), $transformer);
    }

}