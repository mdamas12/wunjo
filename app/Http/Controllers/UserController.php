<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roleuser;
use App\Models\Rolesystem; 
use App\Models\Branch;
use App\Models\Userbranch;
use Spatie\Permission\Models\Role;
use Inertia\Response; 
use Hash;


class UserController extends Controller
{
    
    public function index(){
        $users = User::paginate(100);
        $roles = Roleuser::with('rolesystem')->get();
      
        return inertia('Users/index',['users' => $users, 'roles' => $roles]);
    }

    
    public function create(){
        $roles = Role::get();
        $branches = Branch::get();
        return inertia('Users/create', ['roles' => $roles, 'branches' => $branches]);
    }


    public function store(Request $request){
    
        $newuser =   User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)

        ]);
        $newuser->assignRole($request->UserRole);
        
        $branches = $request->userBranches;
            foreach ($branches as $branch) {
                $userbranch =   Userbranch::create([
                    'user_id' => $newuser->id,
                    'branch_id' => $branch['branch_id'],
                ]);
            }

    return redirect()->route('users.index');
       
    }


    public function seacrchroleuser(Request $request){
     $roleid = Roleuser::where('model_id',$request->user)->first();
     $roleuser = Rolesystem::where('id',$roleid->role_id)->first();
     //dd($roleuser->name);
     session()->flash('flash.roleuser', $roleuser->name);
     return redirect()->back(); 
   

    }
}
