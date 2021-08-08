<?php

declare(strict_types=1);

namespace App\Entity;

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
     * @ORM\ManyToMany(targetEntity="App\Entity\Shop", mappedBy="flower")
     */
    private Collection $shops;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FlowerAttribute", mappedBy="flower")
     */
    private $flowerAttribute;

    public function __construct(string $name) {
        $this->name = $name;
        $this->shops = new ArrayCollection();
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

    public function setShop(ShopInterface $shop): FlowerInterface
    {
        $this->shops->add($shop);
        return $this;
    }
}
