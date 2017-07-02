<?php
namespace App\Api\Controllers;

use App\Model\Offer;
use App\Model\Product\StockedProduct;
use App\Repository\OfferRepository;
use App\Repository\ProductCategoryRepository;
use App\Repository\ProductRepository;
use App\Transformers\OfferTransformer;
use App\Transformers\ProductCategoryTransformer;
use App\Transformers\StockTransformer;
use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Http\Request;
use Dingo\Api\Http\Response;
use Dingo\Blueprint\Annotation\Method\Post;
use Dingo\Blueprint\Annotation\Resource;
use Dingo\Blueprint\Annotation\Method\Get;
use Illuminate\Support\Facades\Validator;

/**
 * Class ProductsController
 * @package App\Api\Controllers
 *
 * @Resource("Products", uri="/products")
 */
class ProductsController extends ApiBaseController
{
    /**
     * List product related of some product
     *
     * @Get("/{id}/related")
     *
     * @param $id
     * @param ProductRepository $repo
     * @param StockTransformer $transformer
     * @return Response
     */
    public function related($id, ProductRepository $repo, StockTransformer $transformer): Response {
        $products = $repo->findRelatedTo($id);

        return $this->response->collection(collect($products), $transformer);
    }
}