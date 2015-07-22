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
use Illuminate\Support\Str;

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
    protected $fillable = ['name', 'slug'];

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
        return $this->belongsToMany('Ethereal\User\User');
    }

    /**
     * The relationship between Role and Permission models.
     *
     * @return array
     */
    public function permissions()
    {
        return $this->belongsToMany('Ethereal\User\Permission', 'permissions_roles', 'role_id', 'permission_id');
    }

    /**
     * This method tells if the Role has the Permission or not.
     *
     * @param $permission
     * @return boolean
     */
    public function can($permission)
    {
        foreach ($this->permissions() as $p) {
            if ($p->name == $permission) {
                return (boolean)$p->access;
            }
        }

        return false;
    }

    /**
     * Add permission to Role
     *
     * @param $permission array|string
     * @return mixed
     */
    public function attachPermission($permission)
    {
        $permissionIds = array();

        if (!is_array($permission)) {
            $permission = explode('|', $permission);
        }

        foreach ($permission as $p) {

            $permissionObj = Permission::firstOrCreate([
                'name' => $p,
                'slug' => Str::slug($p),
            ]);

            if (!$this->has($p)) {
                $permissionIds[] = $permissionObj->id;
            }
        }

        $this->permissions()->attach($permissionIds);
    }

    /**
     * Remove permission from Role
     *
     * @param $permission
     * @return mixed
     */
    public function detachPermission($permission)
    {
        $permissionIds = array();

        if (!is_array($permission)) {
            $permission = explode('|', $permission);
        }

        foreach ($permission as $p) {

            $permissionObj = Permission::where('slug', '=', Str::slug($p))->first();

            if($this->has($p))
            $permissionIds[] = $permissionObj->id;
        }

        $this->permissions()->attach($permissionIds);
    }
}