<?php

namespace App\Services;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Photo;
use App\Models\RealEstate;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Response;

class RealEstateService
{
    protected $realEstate;

    public function __construct(RealEstate $realEstate)
    {
        $this->realEstate = $realEstate;
    }
    public function paginate(Builder $query, $perPage, $currentPage)
    {
        return $query->paginate($perPage, ['*'], 'page', $currentPage);
    }
    public function list($requestParams)
    {
        $user = auth()->user();
        if (!$user)
            return RealEstate::query()->where('status', 'to sale')->orWhere('status', 'to rent')->get();
        $user_type = $user->type;
        if ($user_type == 'admin' || $user_type == 'user')
            return RealEstate::all();
        else {

            return RealEstate::query()->where('status', 'to sale')->orWhere('status', 'to rent')->get();
        }
        // return $this->paginate($query, $requestParams['perPage'] ?? 5, $requestParams['page'] ?? 0);
    }

    /**
     * Create a new user with the provided data.
     *
     * @param array $data
     * @return \App\Models\User
     */

    public function addRealEstatePhoto($photo)
    {
        $file_name = null;
        if ($photo) {
            $file_name = uniqid() . '_' . $photo->getClientOriginalName();
            Storage::disk('real_estate')->put($file_name, $photo->getContent());
        }
        return $file_name;
    }

    public function addRealEstatePhotos($photos)
    {
        $files = [];
        $file_name = null;
        if (count($photos)) {
            foreach ($photos as $photo) {
                $file_name = $this->addRealEstatePhoto($photo);
                $files[] = $file_name;
            }
        }
        return $files;
    }

    public function deleteRealEstatePhoto($photo)
    {
        Storage::disk('real_estate')->delete($photo->name);
        Photo::find($photo->id)->delete();
    }

    // public function updateUserPhoto($user_id, $photo)
    // {
    //     self::deleteUserPhoto($user_id);
    //     $file_name = self::addUserPhoto($photo);
    //     return $file_name;
    // }

    public function  createRealEstatePhotos($photos, $real_estate_id)
    {
        $photo_model = new Photo();
        if (count($photos)) {
            foreach ($photos as $photo) {
                $new_photo = Photo::create([
                    "name" => $photo,
                    "real_estate_id" => $real_estate_id
                ]);
            }
        }
    }
    public function createRealEstate($data, $user_id)
    {
        $arr_photos = [];
        if (isset($data['photos'])) {
            $arr_photos = $this->addRealEstatePhotos($data['photos']);
        }

        $data['user_id'] = $user_id;
        $realEstate = $this->realEstate->create($data);
        $this->createRealEstatePhotos($arr_photos, $realEstate->id);
        return $realEstate;
    }

    /**
     * Update the user with the given ID.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\User
     */
    public function updateRealEstate($validated, $real_estate_id)
    {
        $old_realestate = RealEstate::findOrFail($real_estate_id);
        if (isset($validated['deletePhotos'])) {
            if (count($validated['deletePhotos'])) {
                foreach ($validated['deletePhotos'] as $photo) {
                    Photo::find($photo);
                    $this->deleteRealEstatePhoto($photo);
                }
            }
        }

        if (isset($validated['images'])) {
            if (count($validated['images'])) {
                $arr_photos = $this->addRealEstatePhotos($validated['images']);
                $this->createRealEstatePhotos($arr_photos, $real_estate_id);
            }
        }

        // get changes
        $old_realestate->fill($validated);
        $changes = $old_realestate->getDirty();

        if (!empty($changes)) {
            $old_realestate->update($changes);
        }
        return $old_realestate;
    }

    /**
     * Delete the user with the given ID.
     *
     * @param int $id
     * @return bool|null
     * @throws \Exception
     */
    public function deleteUser($id)
    {
        $user = $this->realEstate->findOrFail($id);
        return $user->delete();
    }

    /**
     * Find a user by ID.
     *
     * @param int $id
     * @return \App\Models\User
     */
    public function findUserById($id)
    {
        return $this->realEstate->findOrFail($id);
    }
    public static function getRealEstatePhoto($imageName)
    {
        $filePath = (string)$imageName;
        if (!Storage::disk('real_estate')->exists($filePath)) {
            return null;
        }
        $photo = Storage::disk('real_estate')->get($filePath);
        return Response::make($photo, 200, ['Content-Type' => 'image']);
    }
}