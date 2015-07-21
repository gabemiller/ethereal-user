<?php
/**
 * Created by PhpStorm.
 * User: Gábor
 * Date: 2015.07.18.
 * Time: 20:17
 */

namespace Ethereal\User;


use Ethereal\User\Interfaces\PermissionInterface;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model implements PermissionInterface
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'permissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'access'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Relationship between Role and Permission models
     *
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany('Ethereal\User\Roles');
    }
}