<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;

    protected $fillable = [
    	'user_id',
        'designation_name',
        'status',
    ];

    public function userinfo()
    {
        return $this->hasOne(Userinfo::class);
    }

}
