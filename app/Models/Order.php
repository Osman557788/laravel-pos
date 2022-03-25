<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = [
        'id','client_id','total_price'
    ];

    
    public function client()
    {
        return $this->belongsTo(Client::class);

    }//end of user

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_order')->withPivot('quntity');

    }//end of products
    
    

    
}
