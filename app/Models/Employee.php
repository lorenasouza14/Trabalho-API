<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    protected $fillable = ['name', 'email', 'position','salary', 'department_id'];

    public function department(){
    return $this->belongsTo(Department::class, 'department_id', 'id');
    }
}
