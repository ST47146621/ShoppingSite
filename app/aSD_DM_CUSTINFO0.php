<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class aSD_DM_CUSTINFO0 extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'aSD_DM_CUSTINFO0';
    protected $primaryKey = 'ide';
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}