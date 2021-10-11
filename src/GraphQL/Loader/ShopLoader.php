<?php

declare(strict_types=1);

namespace App\GraphQL\Loader;

use App\Model\Module\Shop\Repository\ShopRepositoryInterface;
use GraphQL\Executor\Promise\Promise;
use GraphQL\Executor\Promise\PromiseAdapter;
use InvalidArgumentException;

class ShopLoader
{
    private PromiseAdapter $promiseAdapter;
    private ShopRepositoryInterface $repository;

    public function __construct(
        PromiseAdapter $promiseAdapter,
        ShopRepositoryInterface $repository
    ) {
        $this->promiseAdapter = $promiseAdapter;
        $this->repository = $repository;
    }

    /**
     * @param array|int[] $shopIds
     * @return Promise
     * @throws InvalidArgumentException
     */
    public function getShopsPromise(array $shopIds): Promise
    {
        $shops = $this->repository->getByIds($shopIds);
        return $this->promiseAdapter->all([$shops]);
    }
}
