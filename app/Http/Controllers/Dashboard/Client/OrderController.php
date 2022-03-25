<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Http\Controllers\Controller;
use App\Models\Catgorie;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
 
    public function create(Client $client)
    {
        $categories = Catgorie::with('products')->get();
        $orders = $client->orders()->with('products')->paginate(5);
        // return $orders- ;    
        return view('dashboard.orders.create', compact( 'client', 'categories', 'orders'));
    }

    public function getProductsWithCategories()
    {
        return Catgorie::with('products')->get();

    }

  
    public function store(Request $request,Client $client)
    {
        $request->validate([
            'products' => 'required|array',
        ]);

        $this->attach_order($request, $client);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.orders.index');
       
    }

    private function attach_order($request, $client)
    {
        $order = $client->orders()->create([]);

        $order->products()->attach($request->products);

        $total_price = 0;

        foreach ($request->products as $id => $quantity) {

            $product = Product::FindOrFail($id);
            $total_price += $product->sale_price * $quantity['quntity'];

            $product->update([
                'stock' => $product->stock - $quantity['quntity']
            ]);

        }//end of foreach

        $order->update([
            'total_price' => $total_price
        ]);

    }//end of attach order

   

   
    public function edit(Order $product)
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
