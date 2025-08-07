<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    protected UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/users",
     *     summary="List all users with details",
     *     tags={"Users"},
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
     *          description="Number of users per page",
     *          required=false,
     *          @OA\Schema(type="integer", example=10)
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Paginated list of users",
     *         @OA\JsonContent(
     *               type="object",
     *               @OA\Property(
     *                   property="data",
     *                   type="array",
     *                   @OA\Items(ref="#/components/schemas/User")
     *               ),
     *              @OA\Property(property="links", type="object"),
     *              @OA\Property(property="meta", type="object")
     *          )
     *     )
     * )
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        return UserResource::collection(
            $this->service->getAll((int) $request->query('perPage', 10))
        );
    }

    /**
     * @OA\Get(
     *     path="/api/v1/users/{user}/favorites",
     *     summary="Get a user's favorite activities",
     *     tags={"Users"},
     *     @OA\Parameter(
     *         name="user",
     *         in="path",
     *         description="User ID",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Parameter(
     *           name="page",
     *           in="query",
     *           description="Page number",
     *           required=false,
     *           @OA\Schema(type="integer", example=1)
     *       ),
     *       @OA\Parameter(
     *           name="perPage",
     *           in="query",
     *           description="Number of users per page",
     *           required=false,
     *           @OA\Schema(type="integer", example=10)
     *       ),
     *     @OA\Response(
     *         response=200,
     *         description="List of favorite activities",
     *         @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(ref="#/components/schemas/User")
     *              ),
     *             @OA\Property(property="links", type="object"),
     *             @OA\Property(property="meta", type="object")
     *         )
     *     ),
     *     @OA\Response(response=404, description="User not found")
     * )
     */
    public function favorites(Request $request, User $user): AnonymousResourceCollection
    {
        return ActivityResource::collection(
            $this->service->getUserFavorites($user, $request->query('perPage', 10))
        );
    }
}
