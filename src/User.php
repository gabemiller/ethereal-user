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


    public function hasRole($role)
    {
        // TODO: Implement hasRole() method.
    }

    public function roles()
    {
        return $this->hasOne('\Ethereal\User\Role');
    }
}