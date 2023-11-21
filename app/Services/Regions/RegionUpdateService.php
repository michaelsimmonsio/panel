<?php

namespace Pterodactyl\Services\Regions;

use Pterodactyl\Models\Region;
use Pterodactyl\Contracts\Repository\RegionRepositoryInterface;

class RegionUpdateService
{
    public function __construct(protected RegionRepositoryInterface $repository)
    {
    }

    public function handle(Region|int $region, array $data): Region
    {
        $region = ($region instanceof Region) ? $region->id : $region;

        return $this->repository->update($region, $data);
    }
}
