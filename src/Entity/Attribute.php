<?php

declare(strict_types=1);

namespace App\Entity;

use App\Model\Entity\AttributeInterface;
use App\Repository\AttributeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Attribute
 *
 * @ORM\Table(
 *     name="attributes"
 * )
 * @ORM\Entity(repositoryClass=AttributeRepository::class)
 */
class Attribute implements AttributeInterface
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): AttributeInterface
    {
        $this->name = $name;

        return $this;
    }
}
