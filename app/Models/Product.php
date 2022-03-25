<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    

    protected $fillable = [
        'name','catgorie_id','image','sale_price','stock','purchase_price','description'
    ];

   
    protected $hidden = [];

    
    protected $casts = [];


    public function getProfitPercentAttribute()
    {
        $profit = $this->sale_price - $this->purchase_price;
        $profit_percent = $profit * 100 / $this->purchase_price;
        return number_format($profit_percent, 2);

    }//end of get profit attribute
    

    public function catgorie()
    {
        return $this->belongsTo(Catgorie::class);

    }//end fo category

    public function orders()
    {
        return $this->belongsToMany(Catgorie::class);

    }//end fo category
}
