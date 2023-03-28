<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\User_DashboardRequest;
use App\Http\Requests\UserRequest;
use App\Models\Admin;
use App\Models\Role;
use App\Models\RoleDashboard;
use App\Models\User;
use Illuminate\Http\Request;
use function Symfony\Component\String\b;

class UsersDasboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:add_users', ['only' => ['index']]);
        $this->middleware('can:add_users', ['only' => ['create','store']]);
        $this->middleware('can:add_users', ['only' => ['edit','update']]);
        $this->middleware('can:add_users', ['only' => ['destroy']]);
    }
    public function index() {
        $users = User::with('role')->latest()->where('id', '<>', auth()->id())->get(); //use pagination here
        return view('users.index', compact('users'));
    }
    public function create(){
        $roles = Role::get();
        return view('users.create',compact('roles'));
    }


    public function store(UserRequest $request) {

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);   // the best place on model
        $user->role_id = $request->role_id;

        // save the new user data
        if($user->save()){



            return redirect()->route('users.Dashboard.index')->with(['success' => 'Add User Success']);
        }
        else
            return redirect()->route('users.Dashboard.index')->with(['success' => 'There is problem']);

    }
    public function edit($id)
    {

        $user = User::find($id);
        $roles = Role::get();

        return view('users.edit', compact('user','roles'));

    }

    public function update(UserRequest $request,$id)
    {
        //validate
        // db

        try {

            $user = User::find($id);


            if ($request->filled('password')) {
                $request->merge(['password' => bcrypt($request->password)]);
            }

            unset($request['id']);
            unset($request['password_confirmation']);

            $user->update($request->except('token','id','redirects_to'));


                return redirect()->route('users.index')->with(['success' => 'Update Success']);





        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => 'There is problem']);

        }

    }
    public function destroy($id){

        $user=User::find($id);

        if (!$user){
            return redirect()->route('users.Dashboard.index')->with(['error' => 'User not found']);
        }
        $user->delete();


            return redirect()->back()->with(['success' => 'Delete Success']);


    }
}

