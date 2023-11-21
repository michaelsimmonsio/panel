<?php

namespace Pterodactyl\Services\Regions;

use Pterodactyl\Models\Region;
use Pterodactyl\Contracts\Repository\RegionRepositoryInterface;

class RegionCreationService
{
    public function __construct(protected RegionRepositoryInterface $repository)
    {
    }

    public function handle(array $data): Region
    {
        return $this->repository->create($data);
    }
}
