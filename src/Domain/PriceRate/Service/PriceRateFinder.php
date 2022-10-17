<?php

namespace App\Domain\PriceRate\Service;

use App\Domain\PriceRate\Repository\PriceRateRepository;

/**
 * Service.
 */
final class PriceRateFinder
{
    /**
     * @var PriceRateRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param PriceRateRepository $repository The repository
     */
    public function __construct(PriceRateRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Find users.
     *
     * @param array<mixed> $params The parameters
     *
     * @return array<mixed> The result
     */
    public function findPriceRates(array $params): array
    {
        return $this->repository->findPriceRates($params);
    }
}
