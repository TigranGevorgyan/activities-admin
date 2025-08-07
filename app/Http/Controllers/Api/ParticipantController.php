<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ParticipantResource;
use App\Services\ParticipantService;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ParticipantController extends Controller
{
    protected ParticipantService $service;

    public function __construct(ParticipantService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/participants",
     *     summary="Get list of participants",
     *     description="Returns paginated list of participants",
     *     tags={"Participants"},
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number",
     *         required=false,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Parameter(
     *         name="perPage",
     *         in="query",
     *         description="Number of participants per page",
     *         required=false,
     *         @OA\Schema(type="integer", example=10)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of participants",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/Participant")
     *             ),
     *             @OA\Property(property="links", type="object"),
     *             @OA\Property(property="meta", type="object")
     *         )
     *     )
     * )
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        return ParticipantResource::collection(
            $this->service->getPaginated((int) $request->query('perPage', 10))
        );
    }
}
