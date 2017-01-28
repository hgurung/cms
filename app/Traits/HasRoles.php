<?php

namespace App\Traits;

use App\Role;
use App\User;
/**
 * Trait HasRoles.
 */
trait HasRoles
{
    /**
     * Returns true if the given user has any of the given roles.
     *
     * @param string|array $roles array or many strings of role name
     *
     * @return bool
     */
    public function hasRoles($roles)
    {
        $roles = is_array($roles) ? $roles : func_get_args();

        foreach ($roles as $role) {

            if ($this->hasRole($role)) {
                return true;
            }

        }

        return false;
    }

    /**
     * Returns if the given user has an specific role.
     *
     * @param string $role
     *
     * @return bool
     */
    public function hasRole($role)
    {
        return Role::where('name', $role)
            ->first() != null;
    }

    /**
     * Returns if the given user has an specific role.
     *
     * @param string $role
     *
     * @return bool
     */
    // public function is($role)
    // {
    //     return $this->hasRole($role);
    // }

    /**
     * Attach the given role.
     *
     * @param \Litepie\User\Role $role
     */
    public function attachRole($role)
    {

        if (!$this->hasRole($role)) {
            Role::attach($role);
        }

    }

    /**
     * Many-to-many role-user relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    /**
     * Detach the given role from the model.
     *
     * @param \Litepie\User\Role $role
     *
     * @return int
     */
    public function detachRole($role)
    {
        return Role::detach($role);
    }

    /**
     * Sync the given roles.
     *
     * @param array $roles
     *
     * @return array
     */
    public function syncRoles($roles)
    {

        if (is_array($roles)) {
            return Role::sync($roles);
        }

        return Role::sync([]);
    }

    /**
     * Take user by roles.
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @param string|array                       $roles
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeWhichRoles($query, $roles)
    {
        return $query->whereHas('roles', function ($query) use ($roles) {
            $roles = (is_array($roles)) ? $roles : [$roles];

            $query->whereIn('name', $roles);
        });
    }

}
