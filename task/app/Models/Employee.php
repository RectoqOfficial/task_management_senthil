<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'password', 'contact', 'gender',
        'department', 'role_id', 'joining_date'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
