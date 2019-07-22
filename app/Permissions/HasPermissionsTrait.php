<?php
namespace App\Permissions;

use App\Role;

trait HasPermissionsTrait {

  public function roles()
  {
    return $this->belongsToMany('App\Role', 'user_role');
  }

  public function hasRole($roles)
  {
    if(is_array($roles)){
      foreach ($roles as $r) {
        if($this->roles->contains('description', $r)){
          return true;
        }
      }
    } else {
      return $this->roles->contains('description', $roles);
    }
    return false;
  }
}
