<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Catgorie;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class GETCategoriesProduct extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catgorie = Catgorie::with(['product'])->get();

        
        // dd($catgorie[0]->);
        return $catgorie ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function relation(){
        
       return Order::find(2)->products()->get( );

    }
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {

    }

   
    public function show($id)
    {
        //
    }

  
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
