<?php
/**
 * Created by PhpStorm.
 * User: Gábor
 * Date: 2015.06.30.
 * Time: 14:18
 */

namespace Ethereal\User;


use Ethereal\User\Interfaces\RoleInterface;
use Illuminate\Database\Eloquent\Model;

class Role extends Model implements RoleInterface
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function users()
    {
        return $this->belongsToMany('\Ethereal\User\User');
    }

    public function permissions()
    {
        return $this->hasMany('\Ethereal\User\Permission');
    }

    public function hasPermission($permission)
    {
        // TODO: Implement hasPermission() method.
    }
}