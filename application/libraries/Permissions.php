<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * This class loads permissions
 * if is logged like employee will get permissions from db
 * if is logged like user will get default permissions array = full rights
 */

class Permissions
{

    private $permissions;

    public function __construct($permissions = null)
    {
        $this->permissions = array();
        if (defined('EMPLOYEE_ID')) {
            foreach ($permissions as $row) {
                $this->permissions[$row["perm"]] = $row["role"];
            }
        }
    }

    // check if a permission is set
    public function hasPerm($permission)
    {
        /*
         * if not defined is user
         * give him full rules
         */
        if (!defined('EMPLOYEE_ID')) {
            return true;
        }
        return $this->permissions[$permission] == 1 ? true : false;
    }

}
