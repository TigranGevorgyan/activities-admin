<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityResource;
use App\Models\Activity;
use App\Services\ActivityService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Activities API",
 *     description="API documentation for Activities",
 * )
 */
class ActivityController extends Controller
{
    protected ActivityService $service;

    public function __construct(ActivityService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/activities",
     *     summary="Get all activities",
     *     tags={"Activities"},
     *     @OA\Parameter(
     *          name="page",
     *          in="query",
     *          description="Page number",
     *          required=false,
     *          @OA\Schema(type="integer", example=1)
     *      ),
     *      @OA\Parameter(
     *          name="perPage",
     *          in="query",
     *          description="Number of activities per page",
     *          required=false,
     *          @OA\Schema(type="integer", example=10)
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Activity"))
     *          )
     *     )
     * )
     */
    public function index(Request $request): JsonResponse
    {
        return response()->json(
            ActivityResource::collection($this->service->getAllPaginated(
                (int) $request->query('perPage', 10))
            )
        );
    }

    /**
     * @OA\Get(
     *     path="/api/v1/activities/{id}",
     *     operationId="getActivityById",
     *     tags={"Activities"},
     *     summary="Get activity by ID",
     *     description="Returns a single activity with its participant and activityType",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Activity ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
 *              @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/Activity"
     *              )
     *          )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Activity not found"
     *     )
     * )
     */
    public function show(Activity $activity): JsonResponse
    {
        return response()->json(new ActivityResource(
            $activity->load(['participant', 'activityType'])
        ));
    }
}
