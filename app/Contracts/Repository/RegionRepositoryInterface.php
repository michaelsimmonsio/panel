<?php

namespace Pterodactyl\Contracts\Repository;

use Pterodactyl\Models\Region;
use Illuminate\Support\Collection;

interface RegionRepositoryInterface extends RepositoryInterface
{
    /**
     * Return regions with a count of locations attached to it.
     */
    public function getAllWithDetails(): Collection;

    /**
     * Return all the available regions with the locations as a relationship.
     */
    public function getAllWithLocations(): Collection;

    /**
     * Return a region and its associated locations.
     *
     * @throws \Pterodactyl\Exceptions\Repository\RecordNotFoundException
     */
    public function getWithLocations(int $id): Region;
}
