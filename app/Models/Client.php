<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
    	'user_id',
        'client_name',
        'client_email',
        'client_phone',
        'company_name',
        'client_address',
        'image',
    ];

    public function getImageAttribute($value)
    {
        $decodedFilename = rawurldecode($value);
        $baseUrl = url('/');
        if($value == NULL)
        {
            return $decodedFilename;
        }
        else
        {
            return $baseUrl . '/' . $decodedFilename;
        }
        
    }


    public function setImageAttribute($value)
    {   
        if($value != "")
        {
            $filename = rawurlencode(basename($value));
            $this->attributes['image'] = "uploads/clients/".$filename;
        }
        
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

}
