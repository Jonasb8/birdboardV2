<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any app models projects.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the app models project.
     *
     * @param  \App\Models\User  $user
     * @param  \App\AppModelsProject  $appModelsProject
     * @return mixed
     */
    public function view(User $user, Project $project)
    {
        //
    }

    /**
     * Determine whether the user can create app models projects.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->id === $project->owner->id;
    }

    /**
     * Determine whether the user can update the app models project.
     *
     * @param  \App\Models\User  $user
     * @param  \App\AppModelsProject  $appModelsProject
     * @return mixed
     */
    public function update(User $user, Project $project)
    {
        return $user->id === $project->owner->id;
    }

    /**
     * Determine whether the user can delete the app models project.
     *
     * @param  \App\Models\User  $user
     * @param  \App\AppModelsProject  $appModelsProject
     * @return mixed
     */
    public function delete(User $user, Project $project)
    {
        //
    }

    /**
     * Determine whether the user can restore the app models project.
     *
     * @param  \App\Models\User  $user
     * @param  \App\AppModelsProject  $appModelsProject
     * @return mixed
     */
    public function restore(User $user, Project $project)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the app models project.
     *
     * @param  \App\Models\User  $user
     * @param  \App\AppModelsProject  $appModelsProject
     * @return mixed
     */
    public function forceDelete(User $user, Project $project)
    {
        //
    }
}
