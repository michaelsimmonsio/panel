<?php

namespace Pterodactyl\Services\Regions;

use Pterodactyl\Models\Region;
use Pterodactyl\Contracts\Repository\RegionRepositoryInterface;

class RegionDeletionService
{
    public function __construct(protected RegionRepositoryInterface $repository)
    {
    }

    public function handle(Region|int $region): ?int
    {
        $region = ($region instanceof Region) ? $region->id : $region;

        // Add any checks for dependencies here if needed

        return $this->repository->delete($region);
    }
}
