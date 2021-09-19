<?php

declare(strict_types=1);

namespace App\GraphQL\Mutation;

use App\Model\Entity\FlowerInterface;
use App\Model\Exception\FlowerCreationException;
use App\Model\Module\Flower\Service\FlowerCreationDtoFillerInterface;
use App\Model\Module\Flower\Service\FlowerServiceInterface;
use Overblog\GraphQLBundle\Definition\ArgumentInterface;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;
use Overblog\GraphQLBundle\Error\UserWarning;
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
     * @param ArgumentInterface $args
     * @return FlowerInterface
     * @throws FlowerCreationException
     * @throws UserWarning
     */
    public function createFlower(ArgumentInterface $args): FlowerInterface
    {
        $this->showWarningMessageExample($args['input']['name']);
        try {
            $flowerDto = $this->flowerCreationDtoFiller->filling($args['input']);
            $flower = $this->flowerService->create($flowerDto);
        } catch (Throwable $e) {
            throw new FlowerCreationException($e->getMessage());
        }

        return $flower;
    }

    public static function getAliases(): array
    {
        return [
            'createFlower' => 'create_flower',
        ];
    }

    /**
     * @param string $flowerName
     * @throws UserWarning
     */
    private function showWarningMessageExample(string $flowerName): void
    {
        if ($flowerName === 'Роза') {
            throw new UserWarning('Осторожно! Роза может Вас уколоть своими шипами.');
        }
    }
}
