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
     * @param $role \Ethereal\User\Role
     * @return boolean
     */
    public function hasRole($role)
    {
        return $this->role->name == $role;
    }

    /**
     * The relationship between User and Role models
     *
     * @return mixed
     */
    public function role()
    {
        return $this->hasOne('\Ethereal\User\Role');
    }

    /**
     * Check the user has Admin or Moderator permission
     *
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->roles->hasPermission('moderator');
    }
}