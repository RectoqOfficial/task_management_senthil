<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Employee extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'password', 'contact', 'gender',
        'department', 'role_id', 'joining_date'
    ];

    protected $hidden = [
        'password',
    ];
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
