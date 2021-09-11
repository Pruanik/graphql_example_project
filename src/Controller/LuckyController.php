<?php

namespace App\Controller;

use App\Entity\Flower;
use App\Model\Module\Flower\Repository\FlowerRepositoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController
{
    private FlowerRepositoryInterface $flowerRepository;

    public function __construct(FlowerRepositoryInterface $flowerRepository) {
        $this->flowerRepository = $flowerRepository;
    }

    /**
     * @Route("/lucky")
     */
    public function number(): Response
    {
        try {
            $flower = $this->flowerRepository->getById(540);
            $attributes = $flower->getFlowerAttribute();
            foreach ($attributes as $attribute) {
                var_dump($attribute->getAttribute()->getAttribute(), $attribute->getValue(), '<br>');
            }
        } catch (\Throwable $e) {

        }

        return new Response(
            '<html><body>Lucky number: </body></html>'
        );
    }
}