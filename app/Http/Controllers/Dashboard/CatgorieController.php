<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Catgorie;
use Illuminate\Http\Request;

class CatgorieController extends Controller
{
    

    public function index(Request $request)
    {
            
        $catgories  =  Catgorie::all();

        $catgories = catgorie::where(function ($q) use ($request) {

            return $q->when($request->search, function ($s) use ($request) {

                return $s->where('name', 'like', '%' . $request->search . '%');

            });

        })->paginate(10);

      return view('dashboard.catgories.index',compact('catgories'));


    }




    public function create()
    {
        return view('dashboard.catgories.create');
    }

  
    public function store(Request $request)
    {
        
        // dd($request->all());
        $request->validate([

            'name' => 'required|unique:catgories,name,except,id',
            
        ]);
        

        Catgorie::create($request->all());
        
        return redirect()->route('dashboard.catgorie.index');
    }

   

   
    public function edit(Catgorie $catgorie)
    {
        return view('dashboard.catgories.edit',compact('catgorie'));
    }

   


    public function update(Request $request,Catgorie $catgorie)
    {

        $request->validate([

            'name' => 'required|unique:catgories,name,except,id',
            
        ]); 
        
        $catgorie -> update($request->all());
        
        return redirect()->route('dashboard.catgorie.index');
        
    }

   



    public function destroy(Catgorie $catgorie)
    {
        
        $catgorie->delete();

        session()->flash('success','catgorie successful deleted');

        return redirect()->back();
       
    }
}
