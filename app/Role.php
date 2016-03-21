<?php

namespace Gecx;

use Illuminate\Database\Eloquent\Model;

class Role extends Model{
  protected $table = 'roles';
  public $timestamps = false;

  public function roles($userId){
    $collection = $this
      ->select(['roles.key'])
      ->join('profile_role',  'profile_role.role_id',     '=', 'roles.id')
      ->join('profiles',      'profiles.id',              '=', 'profile_role.profile_id')
      ->join('user_profiles', 'user_profiles.profile_id', '=', 'profiles.id')
      ->join('users',         'users.id',                 '=', 'user_profiles.user_id')
      ->where('users.id', $userId)
      ->groupby('roles.id')
      ->get();

    $roles = [];
    foreach ($collection as $item) {
      $roles[] = $item->key;
    }  

    return $roles;
  }
}
