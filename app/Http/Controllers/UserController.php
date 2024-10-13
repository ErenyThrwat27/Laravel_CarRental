<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contact;

use Illuminate\Support\Facades\Auth;
class UserController extends Controller
 {
     public function __construct()    //required Login first
     {
         $this->middleware('auth');
     }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users=User::get();
          $user_name= Auth::user()->name;
        return view('admin.users',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.addUser');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $messages=['name.required'=>'Please enter your name',
                    'email.required'=>'Please add your email',
                    'email.unique'=>'Email is already exist',
                    'password' => 'your_password_here'
         ];
         $request->validate([
             'name'=>'required|string|max:225',
             'email'=>'required|email|unique:users',
             'password' => 'required|string|min:8'
         ],$messages); 
        $users=new User();
        $users->name=$request->name;
        $users->email=$request->email;
        $users->password=$request->password;
        $users->save();
        return redirect('/admin/users');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       // $users=User::find($id);
       // return view('users.show',compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users=User::find($id);
        return view('admin.edituser',compact('users',));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages=['name.required'=>'Please enter your name',
                   'email.required'=>'Please add your email',
                   'email.unique'=>'Email is already exist',
                   'password' => 'your_password_here'
        ];
        $request->validate([
            'name'=>'required|string|max:225',
            'email'=>'required|email|unique:users',
            'password' => 'required|string|min:8'
        ],$messages); 
        $users=User::find($id);
        $users->name=$request->name;
        $users->email=$request->email;
        $users->password=$request->password;
        $users->save();
        return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $users=User::find($id)->delete();
        return redirect('/admin/users');
    }
    public function showDeleted(){
        $users=User::onlyTrashed()->get();
        return view('admin.userTrashed',compact('users'));
     }


     public function restore(Request $request){
        $id=$request->id;
        User::where('id',$id)->restore();
        return redirect('/admin/users');
     }
}
