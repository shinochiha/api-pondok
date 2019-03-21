<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\User;

class DefaultPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can read/index the models.
     *
     * @param  String "App\Models\*"  $type
     * @param  Request $request
     * @return mixed
     */
    public function index(String $type, Request $request, ?String $field = null)
    {
        return $request->user()->tokenCan('be-trusted');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  Model $model
     * @return mixed
     */
    public function view(User $user, Model $model, Request $request, ?String $field = null)
    {
        if ($request->user()->tokenCan('read-username-email') && !isset($model[1]) && !isset($field)) {
            return true;
        }
        if ($request->user()->tokenCan('read-basic-profile') && $field === 'profile') {
            return true;
        }
        if ($request->user()->tokenCan('read-education-profile') && $field === 'education') {
            return true;
        }
        if ($request->user()->tokenCan('read-family-profile') && $field === 'family') {
            return true;
        }
        return $request->user()->tokenCan('be-trusted');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $request->user()->tokenCan('be-trusted');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  Model $model
     * @return mixed
     */
    public function update(User $user, Model $model)
    {
        return $request->user()->tokenCan('be-trusted');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  Model $model
     * @return mixed
     */
    public function delete(User $user, Model $model)
    {
        return $request->user()->tokenCan('be-trusted');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  Model $model
     * @return mixed
     */
    public function restore(User $user, Model $model)
    {
        return $request->user()->tokenCan('be-trusted');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  Model $model
     * @return mixed
     */
    public function forceDelete(User $user, Model $model)
    {
        return $request->user()->tokenCan('be-trusted');
    }
}
