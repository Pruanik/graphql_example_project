<?php

declare(strict_types=1);

namespace App\Entity;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(
 *     name="users"
 * )
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @method string getUserIdentifier()
 */
class User implements UserInterface
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true, nullable=false)
     */
    private $apiToken;

    public function getId(): int
    {
        return $this->id;
    }

    public function getApiToken()
    {
        return $this->apiToken;
    }

    public function setApiToken($apiToken): void
    {
        $this->apiToken = $apiToken;
    }

    public function getRoles()
    {
        // TODO: Implement getRoles() method.
    }

    public function getPassword()
    {
        // TODO: Implement getPassword() method.
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }

    public function __call($name, $arguments)
    {
        // TODO: Implement @method string getUserIdentifier()
    }
}