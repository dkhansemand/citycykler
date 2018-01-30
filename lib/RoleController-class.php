<?php

class RoleController extends Database {

    public static function CheckPermission(array $userPermissions, string $permission) : bool 
    {
        foreach($userPermissions as $userPerm){
            return ($userPerm->roleTypeSlug == $permission);
        }
    }

    public static function getRoleTypes() : array 
    {
        return (new self)->query("SELECT roleTypeId, roleTypeName
                                    FROM roleTypes
                                    ORDER BY roleTypeName ASC")->fetchAll();
    }

    public static function getRolePermissions(int $roleId) : array 
    {
        if(isset($roleId) && !empty($roleId)){
            return (new self)->query("SELECT fkRoleType FROM roles WHERE fkUserRole = :ID", 
                                        [':ID' => $roleId])->fetchAll();
        }
        return [];
    }

    public static function doHavePermission(array $permissions, int $roleTypeId) : bool 
    {
        foreach($permissions as $permission){
            return ($permission->fkRoleType == $roleTypeId);
        }
    }

    public static function addRolePermission(int $roleId, int $roleTypeId) : bool 
    {
        if(isset($roleId) && !empty($roleId)
            && isset($roleTypeId) && !empty($roleTypeId) ){
            (new self)->query("INSERT INTO roles (fkUserRole, fkRoleType)
                                VALUES(:UROLE, :TROLE)", 
                                [':UROLE' => $roleId, ':TROLE' => $roleTypeId]);
            return true;
        }
        return false;
    }

    public static function removeRolePermission(int $roleId, int $roleTypeId) : bool 
    {
        if(isset($roleId) && !empty($roleId)
            && isset($roleTypeId) && !empty($roleTypeId) ){
            (new self)->query("DELETE FROM roles WHERE fkUserRole = :UROLE AND fkRoleType = :TROLE", 
                                [':UROLE' => $roleId, ':TROLE' => $roleTypeId]);
            return true;
        }
        return false;
    }

    public static function removeAllPermissions(int $roleId) : bool
    {
        if(isset($roleId) && !empty($roleId)){
            (new self)->query("DELETE FROM roles WHERE fkUserRole = :UROLE", 
                                [':UROLE' => $roleId]);
            return true;
        }
        return false;
    }

}
