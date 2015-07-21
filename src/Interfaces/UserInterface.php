<?php
/**
 * Created by PhpStorm.
 * User: Gábor
 * Date: 2015.06.30.
 * Time: 18:49
 */

namespace Ethereal\User\Interfaces;


interface UserInterface
{
    /**
     * This method tells if the User has the Role or not.
     *
     * @param $role array|string
     * @param $all boolean
     * @return boolean
     */
    public function is($role, $all = true);

    /**
     * Show that the user has the permission
     * or has the permission with the right role
     *
     * @param $permission
     * @param null $role
     * @return mixed
     */
    public function can($permission,$role = null);

    /**
     * The relationship between User and Role models
     *
     * @return mixed
     */
    public function role();

    /**
     * Check the user has Admin or Moderator permission
     *
     * @return boolean
     */
    public function isAdmin();

    /**
     * @param $role
     * @return mixed
     */
    public function attachRole($role);

    /**
     * @param $role
     * @return mixed
     */
    public function detachRole($role);
}