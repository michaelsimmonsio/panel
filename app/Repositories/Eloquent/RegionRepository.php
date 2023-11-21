<?php

namespace Pterodactyl\Repositories\Eloquent;

use Pterodactyl\Models\Region;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Pterodactyl\Exceptions\Repository\RecordNotFoundException;
use Pterodactyl\Contracts\Repository\RegionRepositoryInterface;

class RegionRepository extends EloquentRepository implements RegionRepositoryInterface
{
    /**
     * Return the model backing this repository.
     */
    public function model(): string
    {
        return Region::class;
    }

    /**
     * Return regions with a count of locations attached to it.
     */
    public function getAllWithDetails(): Collection
    {
        return $this->getBuilder()->withCount('locations')->get($this->getColumns());
    }

    /**
     * Return all the available regions with the locations as a relationship.
     */
    public function getAllWithLocations(): Collection
    {
        return $this->getBuilder()->with('locations')->get($this->getColumns());
    }

    /**
     * Return a region and its associated locations.
     *
     * @throws \Pterodactyl\Exceptions\Repository\RecordNotFoundException
     */
    public function getWithLocations(int $id): Region
    {
        try {
            return $this->getBuilder()->with('locations')->findOrFail($id, $this->getColumns());
        } catch (ModelNotFoundException) {
            throw new RecordNotFoundException();
        }
    }
}
