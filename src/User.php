<?php
/**
 * Created by PhpStorm.
 * User: Gábor
 * Date: 2015.06.30.
 * Time: 14:18
 */

namespace Ethereal\User;


use Ethereal\User\Interfaces\UserInterface;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract, UserInterface
{

    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * This method tells if the User has the Role or not.
     *
     * @param $role array|string
     * @return boolean
     */
    public function is($role, $all = true)
    {
        // Check the $role is array or not
        if (!is_array($role)) {
            $role = explode('|', $role);
        }

        // The user should have all the roles or not
        if ($all) {

            // If user doesn't have at least one role, return false
            foreach ($role as $r) {
                if ($this->role()->slug != Str::slug($r)) {
                    return false;
                }
            }
            return true;
        } else {
            // If user has at least one role, return true
            foreach ($role as $r) {
                if ($this->role()->slug == Str::slug($r)) {
                    return true;
                }
            }
            return false;
        }

    }

    /**
     * Show that the user has the permission
     * or has the permission with the right role
     *
     * @param $permission
     * @param null $role
     * @return mixed
     */
    public function can($permission, $role = null)
    {

        if (!empty($role)) {
            foreach ($this->role() as $r) {
                if ($r->name == $role) {
                    return $r->can($permission);
                }
            }

            return false;
        }

        foreach ($this->role() as $r) {
            return $r->can($permission);
        }

        return false;
    }

    /**
     * The relationship between User and Role models
     *
     * @return mixed
     */
    public function role()
    {
        return $this->belongsToMany('Ethereal\User\Role', 'users_roles', 'user_id', 'role_id');
    }

    /**
     * Check the user has Admin or Moderator permission
     *
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->is(['Admin', 'Moderátor'], false);
    }

    /**
     * @param $role
     * @return mixed
     */
    public function attachRole($role)
    {
        $roleIds = array();

        if (!is_array($role)) {
            $role = explode('|', $role);
        }

        // Find or create the role, and get the id
        foreach ($role as $r) {

            // Get Role id
            $roleObj = Role::firstOrCreate([
                'name' => $r,
                'slug' => Str::slug($r),
            ]);

            $roleIds[] = $roleObj->id;
        }

        // Attach roles to user
        $this->role()->attach($roleIds);
    }

    /**
     * @param $role
     * @return mixed
     */
    public function detachRole($role)
    {
        $roleIds = array();

        if (!is_array($role)) {
            $role = explode('|', $role);
        }

        // Find or create the role, and get the id
        foreach ($role as $r) {

            // Get Role id
            $roleObj = Role::where('slug', '=', Str::slug($r))->first();

            $roleIds[] = $roleObj->id;
        }

        // Detach roles to user
        $this->role()->detach($roleIds);
    }
}