<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Enums\Admin\AdminRoles;
use App\Enums\Gender;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory,Notifiable;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    protected $dates = ['device_token_updated_at'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'roles' => AdminRoles::class,
        'gender' => Gender::class,
        'birthday' => 'date'
    ];

    public function isSuperAdmin(){
        return $this->isRoles(AdminRoles::SuperAdmin);
    }
    public function isAdmin(){
        return $this->isRoles(AdminRoles::Admin);
    }
    public function isRoles(AdminRoles $role){
        return $this->roles == $role;
    }
    public function rolesIn(array $roles){
        foreach($roles as $item){
            if($this->roles == $item){
                return true;
            }
        }
        return false;
    }
}
