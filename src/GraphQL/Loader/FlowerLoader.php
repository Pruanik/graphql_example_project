<?php

declare(strict_types=1);

namespace App\GraphQL\Loader;

use App\Model\Module\Flower\Repository\FlowerRepositoryInterface;
use GraphQL\Executor\Promise\Promise;
use GraphQL\Executor\Promise\PromiseAdapter;
use InvalidArgumentException;

class FlowerLoader
{
    private PromiseAdapter $promiseAdapter;
    private FlowerRepositoryInterface $repository;

    public function __construct(
        PromiseAdapter $promiseAdapter,
        FlowerRepositoryInterface $repository
    ) {
        $this->promiseAdapter = $promiseAdapter;
        $this->repository = $repository;
    }

    /**
     * @param array|int[] $flowerIds
     * @return Promise
     * @throws InvalidArgumentException
     */
    public function all(array $flowerIds)
    {
        $flowers = $this->repository->getByIds($flowerIds);
        return $this->promiseAdapter->all($flowers);
    }
}
