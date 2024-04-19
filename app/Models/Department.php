<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
    	'user_id',
        'department_name',
        'status',
    ];

    public function projects()
    {
    	return $this->hasMany(Project::class);
    }

    public function userinfo()
    {
        return $this->hasOne(Userinfo::class);
    }

}
