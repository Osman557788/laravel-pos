<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Mockery\Expectation;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class UserController extends Controller
{
       
    public function __construct()
    {

        $this->middleware(['permission:users-read'])->only('index');
        $this->middleware(['permission:users-create'])->only('create');
        $this->middleware(['permission:users-update'])->only('edit');
        $this->middleware(['permission:users-delete'])->only('destroy');
       
    }


    public function index(Request $request)
    {
        $users = User::where(function ($q) use ($request) {

        return $q->when($request->search, function ($s) use ($request) {

                return $s->where('first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('last_name', 'like', '%' . $request->search . '%');
            });
        })->paginate(5);

        return view('dashboard.users.index', compact('users'));
    }

    public function create()
    {
        return view('dashboard.users.create'); 
    }

   



    public function store(Request $request)
    {

        $request->validate([
            'first_name' => 'required|max:30',
            'last_name' => 'required|max:30',
            'email' => 'required|unique:users', 
            'password' => 'required|confirmed',
            'permissions' => 'required|min:1',
            'image' => 'image'
        ]);   
        
        $user_data = $request->except(['password','image','permissions']);

        if ($request->image) {

            $request->file('image')
                ->storeAs( 'user_images' , $request->image->hashName(), 'uploads');

            $user_data['image'] = $request->image->hashName();

        }//end of if

        $user_data['password'] = bcrypt($request->password);

        $user = User::create($user_data);

        // $user->attachRole('super_admin');

        $user->syncPermissions($request->permissions);
        
        return redirect()->route('dashboard.user.index');
    }

  

    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    }

  




    public function update(Request $request, User $user)
    {


        $request->validate([
            'first_name' => 'required|max:30',
            'last_name' => 'required|max:30',
            'email' => 'required|max:50',Rule::unique('users', 'email')->ignore($user->id, 'id'), 
        ]);
        
        $user_data = $request->except(['password','permissions','image']);

        if($request->image){

            if($user->image != 'user2-160x160.jpg'){

                Storage::disk('uploads')->delete('user_images/'.$user->image );
                
            }                
            
            $request->file('image')->storeAs( 'user_images' , $request->image->hashName(), 'uploads');
            
            $user_data['image'] = $request->image->hashName();

        }
        $user->update($user_data);


        $user->syncPermissions($request->permissions);
       return redirect()->route('dashboard.user.index');
    }


    public function destroy(User $user)
    {
        $user->delete();

        session()->flash('success','user hase deleted');
        
        return redirect()->back(); 
    }
}
