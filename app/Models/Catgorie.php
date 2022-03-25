<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Catgorie extends Model
{


    protected $fillable = [
        'name'
    ];
    
    protected $hidden =['id','create_at','update_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function products()
    {
        return $this->hasMany(Product::class);

    }//end fo product



}
