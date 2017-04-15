<?php
namespace App\Model;

use App\Model\Product\StockedProduct;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Market
 * @package App\Model
 */
class Market
{
    /**
     * @var ArrayCollection<Box>
     */
    protected $boxes;

    /**
     * @var ArrayCollection<Product>
     */
    protected $products;

    public function __construct()
    {
        $this->boxes = new ArrayCollection();
        $this->products = new ArrayCollection();
    }

    /**
     * @return ArrayCollection<StockedProduct>
     */
    public function getStock(): ArrayCollection
    {
        return $this->products;
    }

    /**
     * @return void
     */
    public function cleanStock(): void
    {
        $this->products->clear();
    }

    /**
     * @param StockedProduct $product
     *
     * @return void
     */
    public function addProduct(StockedProduct $product): void
    {
        $this->products->add($product);
    }

    /**
     * @param Box $box
     *
     * @return void
     */
    public function addBox(Box $box): void
    {
        $this->boxes->add($box);
    }

    /**
     * @return int
     */
    public function estimatedWaitingTime(): int
    {
        $enabled_boxes = $this->boxes->filter(function (Box $box) {
            return $box->isEnabled();
        });

        $box_times = $enabled_boxes->map(function (Box $box) {
            return $box->estimatedWaitingTime();
        })->toArray();

        return array_sum($box_times) / count($box_times);
    }
}