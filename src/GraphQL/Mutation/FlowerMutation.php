<?php

declare(strict_types=1);

namespace App\GraphQL\Mutation;

use App\Model\Exception\FlowerCreationException;
use App\Model\Module\Flower\Service\FlowerCreationDtoFillerInterface;
use App\Model\Module\Flower\Service\FlowerServiceInterface;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;
use Throwable;

class FlowerMutation implements MutationInterface, AliasedInterface
{
    private FlowerServiceInterface $flowerService;
    private FlowerCreationDtoFillerInterface $flowerCreationDtoFiller;

    public function __construct(
        FlowerServiceInterface $flowerService,
        FlowerCreationDtoFillerInterface $flowerCreationDtoFiller
    ) {
        $this->flowerService = $flowerService;
        $this->flowerCreationDtoFiller = $flowerCreationDtoFiller;
    }

    /**
     * @param Argument $args
     * @throws FlowerCreationException
     */
    public function createFlower(Argument $args): void
    {
        try {
            $flowerDto = $this->flowerCreationDtoFiller->fillingFromGraphQLArgument($args);
            $this->flowerService->create($flowerDto);
        } catch (Throwable $e) {
            throw new FlowerCreationException($e->getMessage());
        }
    }

    public static function getAliases(): array
    {
        return [
            'createFlower' => 'create_flower',
        ];
    }
}
