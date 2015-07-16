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
    protected $fillable = ['name','slug','permissions'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];


    /**
     * The relationship between User and Role models.
     *
     * @return mixed
     */
    public function users()
    {
        return $this->belongsToMany('\Ethereal\User\User');
    }

    /**
     * The relationship between Role and Permission models.
     *
     * @return mixed
     */
    public function getPermissions()
    {
        return json_decode($this->permissions);
    }

    /**
     * This method tells if the Role has the Permission or not.
     *
     * @param $permission string
     * @return boolean
     */
    public function hasPermission($permission)
    {
        $ps = $this->getPermissions();

        if (!array_key_exists($permission, $ps)) {
            return false;
        }

        return (boolean)$ps[$permission];
    }
}