<?php

declare(strict_types=1);

namespace App\Entity;

use App\Model\Entity\FlowerInterface;
use App\Repository\ShopRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
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
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Flower", inversedBy="shops")
     */
    private $flowers;

    public function __construct() {
        $this->flowers = new ArrayCollection();
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
}
