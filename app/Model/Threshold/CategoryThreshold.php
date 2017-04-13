<?php
namespace App\Model\Threshold;

use App\Model\Price;
use App\Model\Threshold;
use App\Model\Product\ProductCategory;

/**
 * Class CategoryThreshold
 * @package App\Model\Threshold
 */
class CategoryThreshold extends Threshold
{
    /**
     * @var ProductCategory
     */
    private $category;

    public function __construct(Price $limit, ProductCategory $category) {
        parent::__construct($limit);

        $this->category = $category;
    }

    public function getCategory(): ProductCategory {
        return $this->category;
    }
}