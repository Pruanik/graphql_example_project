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
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $attribute;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAttribute(): ?string
    {
        return $this->attribute;
    }

    public function setAttribute(string $attribute): AttributeInterface
    {
        $this->attribute = $attribute;

        return $this;
    }
}
