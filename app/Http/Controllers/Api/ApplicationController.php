<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\GetApplicationListRequest;
use App\Http\Requests\Api\ShowApplicationRequest;
use App\Http\Requests\Api\StoreApplicationRequest;
use App\Http\Resources\Api\Application\ApplicationResource;
use App\Http\Resources\Api\Application\PaginatedApplicationResource;
use App\Models\Application;
use Illuminate\Support\Facades\DB;

class ApplicationController extends Controller
{
    public function list(GetApplicationListRequest $request)
    {
        $builder = Application::query()
            ->with('mainLink');

        if (!is_null($request->validated('sort_by_price'))) {
            $builder->orderBy('price', $request->validated('sort_by_price'));
        }

        if (!is_null($request->validated('sort_by_date'))) {
            $builder->orderBy('created_at', $request->validated('sort_by_date'));
        }

        $applications = $builder->paginate(2);

        return PaginatedApplicationResource::collection($applications);
    }

    /**
     * @param StoreApplicationRequest $request
     * @return array[]
     * @throws \Exception
     */
    public function store(StoreApplicationRequest $request)
    {
        try {
            DB::beginTransaction();

            $application = Application::query()->create([
                'name' => $request->validated('name'),
                'description' => $request->validated('description'),
                'price' => $request->validated('price'),
            ]);

            if (empty($application->id)) {
                throw new \Exception('Cannot create application');
            }

            if (!empty($request->validated('links'))) {
                $linksData = collect($request->validated('links'))->map(fn ($value, $key) => [
                    'is_main' => $key === 0,
                    'link' => $value
                ]);

                $application->links()->createMany($linksData);
            }

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new \Exception($exception->getMessage());
        }

        return ['data' => [
            'id' => $application->id,
        ]];
    }

    /**
     * @param ShowApplicationRequest $request
     * @return ApplicationResource
     */
    public function show(ShowApplicationRequest $request): ApplicationResource
    {
        $application = Application::query()
            ->with('links')
            ->find($request->validated('id'));

        return ApplicationResource::make($application);
    }
}
