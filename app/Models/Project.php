<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
    	'user_id',
        'category_id',
        'client_id',
        'project_name',
        'project_priority',
        'start_date',
        'duration',
        'duration_unit',
        'end_date',
        'project_cost',
        'status',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(Project::class);
    }

    public function department()
    {
        return $this->belongsTo(Project::class);
    }
    
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
