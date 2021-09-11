<?php

declare(strict_types=1);

namespace App\Entity;

use App\Model\Entity\FlowerAttributeInterface;
use App\Model\Entity\ShopInterface;
use App\Repository\FlowerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Model\Entity\FlowerInterface;

/**
 * Flower
 *
 * @ORM\Table(
 *     name="flowers"
 * )
 * @ORM\Entity(repositoryClass=FlowerRepository::class)
 */
class Flower implements FlowerInterface
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var Collection|ShopInterface[]
     * @ORM\ManyToMany(targetEntity="App\Entity\Shop", mappedBy="flower")
     */
    private Collection $shops;

    /**
     * @var Collection|FlowerAttributeInterface[]
     * @ORM\OneToMany(targetEntity="App\Entity\FlowerAttribute", mappedBy="flower",cascade={"persist"})
     */
    private Collection $flowerAttributes;

    public function __construct() {
        $this->shops = new ArrayCollection();
        $this->flowerAttributes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): FlowerInterface
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|ShopInterface[]
     */
    public function getShops(): Collection
    {
        return $this->shops;
    }

    public function addShop(ShopInterface $shop): FlowerInterface
    {
        if (!$this->shops->contains($shop)) {
            $this->shops[] = $shop;
        }
        return $this;
    }

    /**
     * @return Collection|FlowerAttributeInterface[]
     */
    public function getFlowerAttributes(): Collection
    {
        return $this->flowerAttributes;
    }

    public function addFlowerAttribute(FlowerAttributeInterface $flowerAttribute): FlowerInterface
    {
        if (!$this->flowerAttributes->contains($flowerAttribute)) {
            $this->flowerAttributes[] = $flowerAttribute;
        }
        return $this;
    }
}
