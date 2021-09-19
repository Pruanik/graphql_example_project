<?php

declare(strict_types=1);

namespace App\Model\Module\Shop\Service;

use App\Model\Module\Flower\Service\FlowerCreationDtoFillerInterface;
use App\Model\Module\Purchase\Service\PurchaseCreationDtoFillerInterface;
use App\Model\Module\Shop\Dto\ShopCreationDto;
use Spatie\DataTransferObject\DataTransferObjectError;

class ShopCreationDtoFiller implements ShopCreationDtoFillerInterface
{
    private FlowerCreationDtoFillerInterface $flowerDtoFiller;
    private PurchaseCreationDtoFillerInterface $purchaseDtoFiller;

    public function __construct(
        FlowerCreationDtoFillerInterface $flowerDtoFiller,
        PurchaseCreationDtoFillerInterface $purchaseDtoFiller
    ) {
        $this->flowerDtoFiller = $flowerDtoFiller;
        $this->purchaseDtoFiller = $purchaseDtoFiller;
    }

    /**
     * @param array $args
     * @return ShopCreationDto
     * @throws DataTransferObjectError
     */
    public function filling(array $args): ShopCreationDto
    {
        $buildArray = [
            'name'    => $args['name'],
            'address' => $args['address'] ?? null,
        ];

        if (isset($args['flowers'])) {
            foreach ($args['flowers'] as $flower) {
                $buildArray['flowers'][] = $this->flowerDtoFiller->filling($flower);
            }
        }

        if (isset($args['purchases'])) {
            foreach ($args['purchases'] as $purchase) {
                $buildArray['purchases'][] = $this->purchaseDtoFiller->filling($purchase);
            }
        }

        return ShopCreationDto::buildFromArray($buildArray);
    }
}
