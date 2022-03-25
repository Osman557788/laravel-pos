<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Catgorie;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    

    public function index(Request $request)
    {
            
        $categories  = Catgorie::all();

        $products = Product::when($request->search, function ($q) use ($request) {

            return $q->whereTranslationLike('name', '%' . $request->search . '%');

        })->when($request->category_id, function ($q) use ($request) {

            return $q->where('category_id', $request->category_id);

        })->paginate(10);

        return view('dashboard.products.index', compact('categories', 'products'));


    }




    public function create()
    {
        $categories = Catgorie::all();
        return view('dashboard.products.create', compact('categories'));
    }

  
    public function store(Request $request)
    {
        
        $request->validate([

            'name' => 'required|max:40|unique:products,name',
            'description' => 'required',
            'name' => 'required',
            'purchase_price' => 'required|max:10',
            'sale_price' => 'required|',
            
        ]);
        
        
        $data = $request->except('image');

        if ($request->image) {


            $request->file('image')
                ->storeAs( 'products_images' , $request->image->hashName(), 'uploads');

            $data['image'] = $request->image->hashName();

        }//end of if

        // dd($data);

        Product::create($data);

        return redirect()->route('dashboard.product.index');
        
       
    }

   

   
    public function edit(Product $product)
    {
        $categories = Catgorie::all();

        return view('dashboard.products.edit',compact('product','categories'));
    }

   


    public function update(Request $request,Product $product)
    {

        $request->validate([

            'name' => 'required|max:40|unique:products,name',
            'description' => 'required',
            'name' => 'required',
            'purchase_price' => 'required|max:10',
            'sale_price' => 'required|',
            
        ]);
        // dd($request->all());
        $data = $request->except('image');

        if($request->image){

            if($product->image != 'user2-160x160.jpg'){

                Storage::disk('uploads')->delete('products_images/'.$product->image );
                
            }                
            
            $request->file('image')->storeAs( 'products_images' , $request->image->hashName(), 'uploads');
            
            $data['image'] = $request->image->hashName();

        }
        
        
        $product -> update($data);
        
        return redirect()->route('dashboard.product.index');
        
    }

   



    public function destroy(Product $Product)
    {
        
        $Product->delete();

        session()->flash('success','Product successful deleted');

        return redirect()->back();


       
    }
}
