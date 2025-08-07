<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityTypeResource;
use App\Services\ActivityTypeService;
use Illuminate\Http\JsonResponse;

class ActivityTypeController extends Controller
{
    protected ActivityTypeService $service;

    public function __construct(ActivityTypeService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/activity-types",
     *     summary="Get all activity types",
     *     tags={"Activity Types"},
     *     @OA\Response(
     *         response=200,
     *         description="List of activity types",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/ActivityType")
     *          )
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        return response()->json(ActivityTypeResource::collection(
            $this->service->getAll()
        ));
    }
}
