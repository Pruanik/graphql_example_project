<?php

declare(strict_types=1);

namespace App\Entity;

use App\Model\Entity\AttributeInterface;
use App\Model\Entity\FlowerAttributeInterface;
use App\Model\Entity\FlowerInterface;
use App\Repository\FlowerAttributeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Shop
 *
 * @ORM\Table(
 *     name="flower_attribute"
 * )
 * @ORM\Entity(repositoryClass=FlowerAttributeRepository::class)
 */
class FlowerAttribute implements FlowerAttributeInterface
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var FlowerInterface
     * @ORM\ManyToOne(targetEntity="App\Entity\Flower")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="flower_id", referencedColumnName="id")
     * })
     */
    private $flower;

    /**
     * @var AttributeInterface
     * @ORM\ManyToOne(targetEntity="App\Entity\Attribute")
     * @ORM\JoinColumn(nullable=false)
     */
    private $attribute;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $value;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFlower(): ?FlowerInterface
    {
        return $this->flower;
    }

    public function setFlower(FlowerInterface $flower): FlowerAttributeInterface
    {
        $this->flower = $flower;

        return $this;
    }

    public function getAttribute(): ?AttributeInterface
    {
        return $this->attribute;
    }

    public function setAttribute(AttributeInterface $attribute): FlowerAttributeInterface
    {
        $this->attribute = $attribute;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getAttributeName(): string
    {
        return $this->attribute->getName();
    }
}
