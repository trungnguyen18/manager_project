<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(){
        return $this->belongsToMany(Role::class,'role_user','user_id','role_id');
    }

    public function checkPermissionAccess($permissionCheck){
        
        //user login có vai trò list_user, add_user, edit_user, list_role, add_role
        // B1: lấy tất cả các quyền cảu user đang login
        $roles = auth()->user()->roles;
        // dd($roles);
        foreach($roles as $role){
            $permission = $role->permissions;
            // dd($permission);
            if($permission->contains('key_code',$permissionCheck)){
                return true;
            }    
        }
        return false;
        // b2: So sánh giá trị của router hiện tại xem có tồn tại trong các quyền mà mình lấy được không
    }
}
