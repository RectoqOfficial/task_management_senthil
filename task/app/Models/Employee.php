<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Employee extends Authenticatable
{
    use Notifiable;
    protected $table = 'employees';
    protected $guard = 'employee';
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
    public function tasks()
{
    return $this->hasMany(Task::class, 'employee_id');
}

}
