<?php
namespace App\Model;

use Carbon\Carbon;
use DateTime;
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
     * @var int
     */
    protected $id;

    /**
     * Many Offers have One ProductCategory
     * @ORM\ManyToOne(targetEntity="\App\Model\ProductCategory", inversedBy="offers")
     * @var ProductCategory
     */
    protected $category;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    protected $percentage;
    /**
     * @ORM\Column(type="datetime")
     * @var DateTime
     */
    private $validFrom;
    /**
     * @ORM\Column(type="datetime")
     * @var DateTime
     */
    private $validTo;

    public function __construct(ProductCategory $category, int $percentage, $validFrom, $validTo)
    {
        $this->category = $category;
        $this->percentage = $percentage;
        $this->validFrom = Carbon::parse($validFrom);
        $this->validTo = Carbon::parse($validTo);
    }

    public function __toString()
    {
        return self::class . "({$this->id})";
    }

    /**
     * @return int
     */
    public function getId(): int  {
        return $this->id;
    }

    /**
     * @return ProductCategory
     */
    public function getCategory(): ProductCategory {
        return $this->category;
    }

    /**
     * @return int
     */
    public function getPercentage(): int {
        return $this->percentage;
    }

    /**
     * @return DateTime
     */
    public function getValidFrom(): DateTime {
        return $this->validFrom;
    }

    /**
     * @return DateTime
     */
    public function getValidTo(): DateTime {
        return $this->validTo;
    }
}