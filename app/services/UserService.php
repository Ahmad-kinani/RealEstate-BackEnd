<?php

namespace App\Services;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Response;

class UserService
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function paginate(Builder $query, $perPage, $currentPage)
    {
        return $query->paginate($perPage, ['*'], 'page', $currentPage);
    }
    public function list($requestParams)
    {
        $query = $this->user->query();
        // sort / search
        // dd($requestParams);
        // $search = $requestParams['search'];
        // dd($search);
        // $query = $query->whereAny(User::$searchable, 'ilike', "%'$search'%");
        // $query->where('username', 'ilike', "%$search%");

        return $this->paginate($query, $requestParams['perPage'] ?? 5, $requestParams['page'] ?? 0);
    }

    /**
     * Create a new user with the provided data.
     *
     * @param array $data
     * @return \App\Models\User
     */
    public function addUserPhoto($photo)
    {
        $file_name = null;
        if ($photo) {
            $file_name = uniqid() . '_' . $photo->getClientOriginalName();
            Storage::disk('users')->put($file_name, $photo->getContent());
        }
        return $file_name;
    }

    public function deleteUserPhoto($user_id)
    {
        $user = User::find($user_id);
        if (isset($user->photo)) {
            Storage::disk('users')->delete($user->photo);
        }
    }

    public function updateUserPhoto($user_id, $photo)
    {
        self::deleteUserPhoto($user_id);
        $file_name = self::addUserPhoto($photo);
        return $file_name;
    }
    public function createUser($data)
    {
        if (isset($data['photo']))
            $data['photo'] = $this->addUserPhoto($data['photo']);
        $user = $this->user->create($data);
        return $user;
    }

    /**
     * Update the user with the given ID.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\User
     */
    public function updateUser($validated, $user_id)
    {
        $old_user = User::find($user_id);

        if (isset($validated['photo'])) {
            $path_photo = $this->updateUserPhoto($old_user->id, $validated['photo']);
            $validated['photo'] = $path_photo;
        } else {
            $this->deleteUserPhoto($old_user->id);
        }

        // get changes
        $old_user->fill($validated);
        $changes = $old_user->getDirty();

        if (!empty($changes)) {
            $old_user->update($changes);
        }
        return $old_user;
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
        $user = $this->user->findOrFail($id);
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
        return $this->user->findOrFail($id);
    }
    public static function getUserPhoto($imageName)
    {
        $filePath = (string)$imageName;
        if (!Storage::disk('users')->exists($filePath)) {
            return null;
        }
        $photo = Storage::disk('users')->get($filePath);
        return Response::make($photo, 200, ['Content-Type' => 'image']);
    }
}
