<?php

namespace App\Http\Controllers;

use App\Http\Requests\addRealEstateRequest;
use App\Http\Requests\DeleteRealEstateRequest;
use App\Http\Requests\UpdateRelaEstateRequest;
use App\Http\Resources\RealEstateResource;
use App\Models\RealEstate;
use App\Services\RealEstateService;
use App\Utilities\ApiResponseService;
use Illuminate\Http\Request;
use PhpParser\Node\Name\Relative;

class RealEstateController extends Controller
{
    protected $realEstateService;

    public function __construct(RealEstateService $realEstateService)
    {
        $this->realEstateService = $realEstateService;
    }

    public function index()
    {
        //
    }

    public function list(Request $request)
    {
        // $requestParams = $request->input('requestParams');
        $requestParams = json_decode($request->input('requestParams', '{}'), true);
        $RealEstate = $this->realEstateService->list($requestParams);
        return  RealEstateResource::collection($RealEstate);

        // return $users;
        // return ApiResponseService::successResponse(UserResource::collection($users));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(addRealEstateRequest  $request)
    {
        $real_estate = $this->realEstateService->createRealEstate($request->all(), $request->user()->id);
        return ApiResponseService::successResponse(new RealEstateResource($real_estate));
    }
    /**
     * Display the specified resource.
     */
    public function show(RealEstate $RealEstate)
    {
        return ApiResponseService::successResponse(new RealEstateResource($RealEstate));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRelaEstateRequest $request)
    {
        //
        $validated = $request->validated();
        $real_estate = $this->realEstateService->updateRealEstate($validated, $request->input('id'));
        return ApiResponseService::successResponse(new RealEstateResource($real_estate));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteRealEstateRequest $request)
    {
        $service = new realEstateService(new RealEstate());
        $id = $request->input('id');
        $real_estate = RealEstate::with('photos')->findOrFail($id);
        if (count($real_estate->photos)) {
            foreach ($real_estate->photos as $photo) {
                $service->deleteRealEstatePhoto($photo);
            }
        }
        $real_estate->delete();
        return ApiResponseService::successResponse([]);
    }
    public function getRealEstatePhoto($file_path)
    {
        return realEstateService::getRealEstatePhoto($file_path);
    }

    //
}