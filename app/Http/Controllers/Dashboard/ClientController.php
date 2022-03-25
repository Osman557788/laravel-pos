<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Catgorie;
use App\Models\Cleient;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    

    public function index(Request $request)
    {
            
        $clients  =  Client::all();

        $clients = Client::where(function ($q) use ($request) {

            return $q->when($request->search, function ($s) use ($request) {

                return $s->where('name', 'like', '%' . $request->search . '%')
                         ->orWhere('email', 'like', '%' . $request->search . '%')
                         ->orWhere('phon_number', 'like', '%' . $request->search . '%');

            });

        })->paginate(4);

      return view('dashboard.clients.index',compact('clients'));


    }




    public function create()
    {
        return view('dashboard.clients.create');
    }


  
    public function store(Request $request)
    {
        
        $request->validate([

            'name' => 'required|max:20',
            'phon_number' => 'required|unique:clients,phon_number,except,id',
            'name' => 'required|unique:clients,email,except,id',
            
        ]);
        

        Client::create($request->all());
        
        return redirect()->route('dashboard.client.index');
    }

   

   
    public function edit(Client $client)    
    {
        return view('dashboard.clients.edit',compact('client'));
    }

   


    public function update(Request $request,Client $Client)
    {

        $request->validate([

            'name' => 'required|max:20',
            'phon_number' => 'required|max:30',
            'name' => 'required',
            
        ]);
        
        $Client -> update($request->all());
        
        return redirect()->route('dashboardclient.index');
        
    }

   



    public function destroy(Client $Client)
    {
        
        $Client->delete();

        session()->flash('success','Client successful deleted');

        return redirect()->back();


       
    }


    // public function createOrder(Client $client)
    // {
    //     // dd($client->id);
    //     $categories = Catgorie::all();

    //     return view('dashboard.clients.orders.create',compact('categories','client'));
    // }
}
