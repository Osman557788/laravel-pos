<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{



    protected $fillable = [
        'id','name','phon_number','email',
    ];

   
    protected $hidden = [
    ];

    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);

    }//end fo product
    
}
