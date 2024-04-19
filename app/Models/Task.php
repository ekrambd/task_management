<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
    	'user_id',
        'category_id',
        'department_id',
        'project_id',
        'project_priority',
        'task_title',
        'start_date',
        'duration',
        'duration_unit',
        'end_date',
        'status',
        'description', 
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
