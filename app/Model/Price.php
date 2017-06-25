<?php namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Price
 * @package App\Model
 *
 * @ORM\Entity
 * @ORM\Table(name="prices")
 */
class Price
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;
    /**
     * @ORM\Column(type="float")
     * @var float
     */
    protected $value;
    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    protected $digits;
    /**
     * One Price has Many Products
     * @var Collection|Products[]
     * @ORM\OneToMany(targetEntity="\App\Model\Product", mappedBy="price", cascade={"persist"})
     */
    protected $wishedProducts;

    public function __construct(float $value, int $digits = 2) {
        $this->value  = floatval($value);
        $this->digits = $digits;
    }

    public function isLesserThan(self $another): bool {
        return $this->getValue() < $another->getValue();
    }

    public function isGreaterThan(self $another): bool {
        return $this->getValue() > $another->getValue();
    }

    public function isEqualsThan(self $another): bool {
        return $this->getValue() === $another->getValue();
    }

    public function add(self $another): self {
        $sum = $this->getValue() + $another->getValue();

        return new self($sum, $this->digits);
    }

    public function sub(self $another): self {
        $sub = $this->getValue() - $another->getValue();

        return new self($sub, $this->digits);
    }

    public function multiply(int $scalar): self {
        $mul = $this->getValue() * $scalar;

        return new self($mul, $this->digits);
    }

    public function divide(int $scalar): self {
        $div = $this->getValue() / $scalar;

        return new self($div, $this->digits);
    }

    /*
     * Getters && Setters
     */

    public function getValue(): float {
        return float_formatted($this->value, $this->digits);
    }
}