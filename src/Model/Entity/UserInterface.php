<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Symfony\Component\Security\Core\User\UserInterface as UserSecurityInterface;

interface UserInterface extends UserSecurityInterface
{
    public function getId(): ?int;

    public function getApiToken(): string;

    public function setApiToken(string $apiToken): void;
}