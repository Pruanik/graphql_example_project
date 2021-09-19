<?php

declare(strict_types=1);

namespace App\GraphQL\Mutation;

use App\Model\Entity\ShopInterface;
use App\Model\Exception\ShopCreationException;
use App\Model\Module\Shop\Service\ShopCreationDtoFillerInterface;
use App\Model\Module\Shop\Service\ShopServiceInterface;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;
use Throwable;

class ShopMutation implements MutationInterface, AliasedInterface
{
    private ShopServiceInterface $shopService;
    private ShopCreationDtoFillerInterface $shopDtoFiller;

    public function __construct(
        ShopServiceInterface $shopService,
        ShopCreationDtoFillerInterface $shopDtoFiller
    ) {
        $this->shopService = $shopService;
        $this->shopDtoFiller = $shopDtoFiller;
    }

    /**
     * @param Argument $args
     * @return ShopInterface
     * @throws ShopCreationException
     */
    public function createShop(Argument $args): ShopInterface
    {
        try {
            $shopDto = $this->shopDtoFiller->filling($args['input']);
            var_dump($shopDto);
        } catch (Throwable $e) {
            throw new ShopCreationException($e->getMessage());
        }
    }

    public static function getAliases(): array
    {
        return [
            'createShop' => 'create_shop',
        ];
    }
}
