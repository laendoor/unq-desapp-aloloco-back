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
    public function getStock(): ArrayCollection {
    }

    public function cleanStock(): void {
    }

    public function addProduct(StockedProduct $product): void {
    }
}