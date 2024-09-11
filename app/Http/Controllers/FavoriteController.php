<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteFavoriteRequest;
use App\Http\Requests\DeleteUserRequest;
use App\Models\Favorite;
use App\Http\Requests\StoreFavoriteRequest;
use App\Http\Requests\UpdateFavoriteRequest;
use App\Utilities\ApiResponseService;
use GuzzleHttp\Psr7\Request;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreFavoriteRequest $request)
    {
        //
        $validated = $request->validated();
        $user = Auth()->user();
        $validated['user_id'] = $user->id;

        $favorites = Favorite::query()->where('real_estate_id', $validated['real_estate_id'])->where('user_id', $user->id)->get();
        if (count($favorites))
            return ApiResponseService::successResponse([], "It is your favorite before");

        $favorite = Favorite::create($validated);
        return ApiResponseService::successResponse($favorite);
    }

    /**
     * Display the specified resource.
     */
    public function show(Favorite $favorite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Favorite $favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFavoriteRequest $request, Favorite $favorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteFavoriteRequest $request)
    {
        //
        $request->validated();
        $user = Auth()->user();
        $favorite = Favorite::query()->where('real_estate_id', $request['real_estate_id'])->where('user_id', $user->id);

        $favorite->delete();
        return ApiResponseService::successResponse([]);
    }
}
