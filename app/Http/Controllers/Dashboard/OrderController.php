<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
 
    public function index(Request $request)
    {
            
        $orders = Order::whereHas('client', function ($q) use ($request) {

            return $q->where('name', 'like', '%' . $request->search . '%');

        })->paginate(5);

        // dd($orders->);

        return view('dashboard.orders.index', compact('orders'));



    }


    public function show(Order $order)
    {
        $products = $order->products()->get();
        return view('dashboard.orders.show',compact('products','order'));
    }
        
   
    public function edit(Order $order)
    {
    
        return view('dashboard.orders.edit',compact('order'));
    }
    
    
    public function getProductOfOrder(Order $order)
    {
       
       return $order->products()->get();
       
    }

    public function update(Request $request,Order $order)
    {
        $request->validate([
            'products' => 'required|array',
        ]);

        $this->detach_order($order);

        $this->sync_order($request, $order);

        // session()->flash('success', __('site.updated_successfully'));
        // return redirect()->route('dashboard.orders.index');

    }//end of update

    private function sync_order($request, $order)
    {
        
        $order->products()->sync($request->products);
        $total_price = 0;

        foreach ($request->products as $id => $quntity) {

            $product = Product::FindOrFail($id);
            $total_price += $product->sale_price * $quntity['quntity'];

            $product->update([
                'stock' => $product->stock - $quntity['quntity']
            ]);

        }//end of foreach

        $order->update([
            'total_price' => $total_price
        ]);

    }//end of attach order

    private function detach_order($order)
    {
        foreach ($order->products as $product) {

            $product->update([
                'stock' => $product->stock + $product->pivot->quantity
            ]);

        }//end of for each

    }//end of detach order

    public function destroy(Order $order)
    {
        foreach ($order->products as $product) {

            $product->update([
                'stock' => $product->stock + $product->pivot->quntity
            ]);

        }//end of for each

        $order->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.orders.index');
    
    }//end of order
}
