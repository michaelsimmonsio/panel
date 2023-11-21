<?php

namespace Pterodactyl\Http\Controllers\Admin;

use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Pterodactyl\Http\Requests\Admin\AssignLocationsToRegionFormRequest;
use Pterodactyl\Models\Location;
use Pterodactyl\Models\Region;
use Illuminate\Http\RedirectResponse;
use Prologue\Alerts\AlertsMessageBag;
use Illuminate\View\Factory as ViewFactory;
use Pterodactyl\Exceptions\DisplayException;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Http\Requests\Admin\RegionFormRequest;
use Pterodactyl\Services\Regions\RegionUpdateService;
use Pterodactyl\Services\Regions\RegionCreationService;
use Pterodactyl\Services\Regions\RegionDeletionService;
use Pterodactyl\Contracts\Repository\RegionRepositoryInterface;

class RegionController extends Controller
{
    /**
     * RegionsController constructor.
     */
    public function __construct(
        protected AlertsMessageBag $alert,
        protected RegionCreationService $creationService,
        protected RegionDeletionService $deletionService,
        protected RegionRepositoryInterface $repository,
        protected RegionUpdateService $updateService,
        protected ViewFactory $view
    ) {
    }

    /**
     * Return the regions overview page.
     */
    public function index(): View
    {
        return $this->view->make('admin.regions.index', [
            'regions' => $this->repository->getAllWithDetails(),
        ]);
    }

    /**
     * Return the region view page.
     *
     * @throws \Pterodactyl\Exceptions\Repository\RecordNotFoundException
     */
    public function view(int $id): View
    {
        return $this->view->make('admin.regions.view', [
            'region' => $this->repository->getWithLocations($id),
        ]);
    }

    /**
     * Handle request to create a new region.
     *
     * @throws \Throwable
     */
    public function create(RegionFormRequest $request): RedirectResponse
    {
        $region = $this->creationService->handle($request->normalize());
        $this->alert->success('Region was created successfully.')->flash();

        return redirect()->route('admin.regions.view', $region->id);
    }

    /**
     * Handle request to update or delete a region.
     *
     * @throws \Throwable
     */
    public function update(RegionFormRequest $request, Region $region): RedirectResponse
    {
        if ($request->input('action') === 'delete') {
            return $this->delete($region);
        }

        $this->updateService->handle($region->id, $request->normalize());
        $this->alert->success('Region was updated successfully.')->flash();

        return redirect()->route('admin.regions.view', $region->id);
    }

    /**
     * Delete a region from the system.
     *
     * @throws \Exception
     * @throws \Pterodactyl\Exceptions\DisplayException
     */
    public function delete(Region $region): RedirectResponse
    {
        try {
            $this->deletionService->handle($region->id);

            return redirect()->route('admin.regions');
        } catch (DisplayException $ex) {
            $this->alert->danger($ex->getMessage())->flash();
        }

        return redirect()->route('admin.regions.view', $region->id);
    }
    public function assignLocations(AssignLocationsToRegionFormRequest $request, $regionId)
    {
        $locationIds = $request->input('locations', []);

        // Update each location with the new region_id
        Location::whereIn('id', $locationIds)->update(['region_id' => $regionId]);

        return Redirect::back()->with('success', 'Locations assigned successfully.');
    }
    public function unassignLocations(AssignLocationsToRegionFormRequest $request, $regionId)
    {
        $locationIds = $request->input('locations', []);

        // Set the region_id to null for each location, unassigning them from the region
        Location::whereIn('id', $locationIds)->update(['region_id' => null]);

        return Redirect::back()->with('success', 'Locations unassigned successfully.');
    }



    public function show($id)
    {
        $region = Region::with('locations')->findOrFail($id);
        $allLocations = Location::all();

        return view('admin.regions.view', [
            'region' => $region,
            'allLocations' => $allLocations
        ]);
    }



}
