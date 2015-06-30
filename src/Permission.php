<?php
/**
 * Created by PhpStorm.
 * User: Gábor
 * Date: 2015.06.30.
 * Time: 14:18
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
    
    /**
     * The relationship between Permission and Role models.
     *
     * @return mixed
     */
    public function roles()
    {
        // TODO: Implement roles() method.
    }
}