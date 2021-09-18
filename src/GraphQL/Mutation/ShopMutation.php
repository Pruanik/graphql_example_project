<?php

declare(strict_types=1);

namespace App\GraphQL\Mutation;

use App\Model\Entity\ShopInterface;
use App\Model\Module\Shop\Service\ShopServiceInterface;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

class ShopMutation implements MutationInterface, AliasedInterface
{
    private ShopServiceInterface $shopService;

    public function __construct(
        ShopServiceInterface $shopService
    ) {
        $this->shopService = $shopService;
    }

    /**
     * @param Argument $args
     * @return ShopInterface
     */
    public function createShop(Argument $args): ShopInterface
    {
      //TODO
    }

    public static function getAliases(): array
    {
        return [
            'createShop' => 'create_shop',
        ];
    }
}
