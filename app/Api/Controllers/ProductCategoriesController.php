<?php
namespace App\Api\Controllers;

use App\Model\Offer;
use App\Model\Product\StockedProduct;
use App\Repository\OfferRepository;
use App\Repository\ProductCategoryRepository;
use App\Transformers\OfferTransformer;
use App\Transformers\ProductCategoryTransformer;
use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Http\Request;
use Dingo\Api\Http\Response;
use Dingo\Blueprint\Annotation\Method\Post;
use Dingo\Blueprint\Annotation\Resource;
use Dingo\Blueprint\Annotation\Method\Get;
use Illuminate\Support\Facades\Validator;

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

    /**
     * List product category offers
     *
     * @Get("/offers")
     *
     * @param ProductCategoryRepository $repo
     * @param ProductCategoryTransformer $transformer
     * @return Response
     */
    public function offers(OfferRepository $repo, OfferTransformer $transformer): Response {
        $offers = $repo->findAll();

        return $this->response->collection(collect($offers), $transformer);
    }

    /**
     * Store product category offer
     *
     * @Post("/{id}/offers")
     *
     * @param Request $request
     * @param OfferRepository $repoOffer
     * @param ProductCategoryRepository $repoCat
     * @return Response
     */
    public function storeOffer(Request $request, OfferRepository $repoOffer,
                               ProductCategoryRepository $repoCat): Response {

        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:product_categories,id',
            'percentage'  => 'required|integer|min:1|max:100',
            'valid_from'  => 'required|date',
            'valid_to'    => 'required|date',
        ]);

        if ($validator->fails()) {
            throw new StoreResourceFailedException(
                trans('repo.store.error', ['resource' => trans('repo.resources.offer')]),
                $validator->errors()
            );
        }

        $category_id = $request->input('category_id');
        $percentage  = $request->input('percentage');
        $validFrom   = $request->input('valid_from');
        $validTo     = $request->input('valid_to');

        $category = $repoCat->find($category_id);
        $offer    = new Offer($category, $percentage, $validFrom, $validTo);

        $repoOffer->save($offer);

        return $this->response->created($offer);
    }

}