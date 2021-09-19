<?php

declare(strict_types=1);

namespace App\Entity;

use App\Model\Document\PurchaseInterface;
use App\Model\Entity\FlowerInterface;
use App\Repository\ShopRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use App\Model\Entity\ShopInterface;

/**
 * Shop
 *
 * @ORM\Table(
 *     name="shops"
 * )
 * @ORM\Entity(repositoryClass=ShopRepository::class)
 */
class Shop implements ShopInterface
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
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var Collection|FlowerInterface[]
     * @ORM\ManyToMany(targetEntity="App\Entity\Flower", inversedBy="shops")
     */
    private Collection $flowers;

    /**
     * @var Collection|PurchaseInterface[]
     * @Gedmo\ReferenceMany(type="document", class="App\Document\Purchase", mappedBy="shop")
     */
    private Collection $purchases;

    public function __construct()
    {
        $this->flowers = new ArrayCollection();
        $this->purchases = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): ShopInterface
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): ShopInterface
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection|FlowerInterface[]
     */
    public function getFlowers(): Collection
    {
        return $this->flowers;
    }

    public function addFlower(FlowerInterface $flower): ShopInterface
    {
        if (!$this->flowers->contains($flower)) {
            $this->flowers[] = $flower;
        }
        return $this;
    }

    /**
     * @return Collection|PurchaseInterface[]
     */
    public function getPurchases(): Collection
    {
        return $this->purchases;
    }

    public function addPurchase(PurchaseInterface $purchase): ShopInterface
    {
        if (!$this->purchases->contains($purchase)) {
            $this->purchases[] = $purchase;
        }
        return $this;
    }
}
