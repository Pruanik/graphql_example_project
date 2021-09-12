<?php

namespace App\Controller;

use App\Entity\Flower;
use App\Model\Module\Flower\Repository\FlowerRepositoryInterface;
use App\Model\Module\Purchase\Service\PurchaseServiceInterface;
use App\Model\Module\Shop\Service\ShopServiceInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController
{
    private FlowerRepositoryInterface $flowerRepository;
    private PurchaseServiceInterface $purchaseService;
    private ShopServiceInterface $shopService;

    public function __construct(
        FlowerRepositoryInterface $flowerRepository,
        PurchaseServiceInterface $purchaseService,
        ShopServiceInterface $shopService
    ) {
        $this->flowerRepository = $flowerRepository;
        $this->purchaseService = $purchaseService;
        $this->shopService = $shopService;
    }

    /**
     * @Route("/lucky")
     */
    public function number(): Response
    {
        //try {
            $flower = $this->flowerRepository->getById(551);
            var_dump($flower->getName());

            $attributes = $flower->getFlowerAttributes();
            foreach ($attributes as $attribute) {
                var_dump($attribute->getAttribute()->getName(), $attribute->getValue(), '<br>');
            }
            echo '<br><br><br>';

            $shops = $flower->getShops();
            foreach ($shops as $shop) {
                var_dump($shop->getName(), $shop->getAddress(), '<br>');
            }

//            echo '<br><br><br>';
//            $purchases = $shop->getPurchases();
//            foreach ($purchases as $purchase) {
//                var_dump($purchase);
//            }
        $shop = $this->shopService->find(299);
            var_dump($shop->getName());
            var_dump($shop->getPurchases());

//        $purcahses = $this->purchaseService->findByShopId(299);
//        var_dump($purcahses);
//        } catch (\Throwable $e) {
//
//        }

        return new Response(
            '<html><body>Lucky number: </body></html>'
        );
    }
}