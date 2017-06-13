<?php
namespace App\Model;

use Carbon\Carbon;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Offer
 * @package App\Model
 *
 * @ORM\Entity
 */
class Offer
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * Many Offers have One ProductCategory
     * @ORM\ManyToOne(targetEntity="\App\Model\ProductCategory", inversedBy="offers")
     */
    protected $category;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    protected $percentage;
    /**
     * @ORM\Column(type="datetime")
     * @var Carbon
     */
    private $validFrom;
    /**
     * @ORM\Column(type="datetime")
     * @var Carbon
     */
    private $validTo;

    public function __construct(ProductCategory $category, int $percentage, Carbon $validFrom, Carbon $validTo)
    {
        $this->category = $category;
        $this->percentage = $percentage;
        $this->validFrom = $validFrom;
        $this->validTo = $validTo;
    }

    public function __toString()
    {
        return self::class . "({$this->id})";
    }
}