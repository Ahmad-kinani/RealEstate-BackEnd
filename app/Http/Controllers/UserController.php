<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use App\Utilities\ApiResponseService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        //
    }

    public function list(Request $request)
    {
        // $requestParams = $request->input('requestParams');
        $requestParams = json_decode($request->input('requestParams', '{}'), true);
        $users = $this->userService->list($requestParams);
        return  UserResource::collection($users);

        // return $users;
        // return ApiResponseService::successResponse(UserResource::collection($users));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //
        // $user = User::create($request->all());
        $user = $this->userService->createUser($request->all());
        return ApiResponseService::successResponse(new UserResource($user));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return ApiResponseService::successResponse(new UserResource($user));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request)
    {
        //
        $validated = $request->validated();
        $user = $this->userService->updateUser($validated, $request->input('id'));
        return ApiResponseService::successResponse(new UserResource($user));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteUserRequest $request)
    {
        $id = $request->input('id');
        // $user = $this->userService->deleteUser($id);
        $res = User::findOrFail($id)->delete();
        return ApiResponseService::successResponse($res);
    }
    public function getUserPhoto($file_path)
    {
        return UserService::getUserPhoto($file_path);
    }
}
