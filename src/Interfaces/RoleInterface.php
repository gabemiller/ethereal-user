<?php
/**
 * Created by PhpStorm.
 * User: Gábor
 * Date: 2015.06.30.
 * Time: 18:49
 */

namespace Ethereal\User\Interfaces;


interface RoleInterface
{

    /**
     * The relationship between User and Role models.
     *
     * @return mixed
     */
    public function users();

    /**
     * The relationship between Role and Permission models.
     *
     * @return array
     */
    public function permissions();

    /**
     * This method tells if the Role has the Permission or not.
     *
     * @param $permission
     * @return boolean
     */
    public function can($permission);

    /**
     * Add permission to Role
     *
     * @param $permission array|string
     * @return mixed
     */
    public function attachPermission($permission);

    /**
     * Remove permission from Role
     *
     * @param $permission
     * @return mixed
     */
    public function detachPermission($permission);
}