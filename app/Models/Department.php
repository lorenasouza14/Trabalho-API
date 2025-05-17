<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';
    protected $fillable = ['name', 'email', 'employees_count'];

    public function employees(){
        return $this->hasMany(Employee::class, 'department_id', 'id');
    }
}
