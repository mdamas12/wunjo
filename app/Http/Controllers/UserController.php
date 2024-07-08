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
        $users = User::paginate(5);
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

      /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
       
        $user = User::where('id',$id)->first();
        $roleuser = $user->getRoleNames();
        $userbranch = Userbranch::with('branch')->where('user_id',$id)->get();
        $roles = Role::get();
        $branches = Branch::get();
        return inertia('Users/edit',['useredit' => $user,'roles' => $roles, 'branches' => $branches, 'userbranch' => $userbranch, 'roleuser'=>$roleuser[0]]);
    }

    public function update(Request $request, String $id)
    {
       
        $user = User::where('id',$id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $roleuser = $user->getRoleNames(); 
        if ($request->UserRole != $roleuser[0]){
             //dd("entro");
            $user->roles()->detach();
            $user->assignRole($request->UserRole);  
        }
        $deleteBranchUser = Userbranch::where('user_id', $id)->delete();
        $branches = $request->userBranches;
        foreach ($branches as $branch) {
            $userbranch =   Userbranch::create([
                'user_id' => $id,
                'branch_id' => $branch['branch_id'],
            ]);
        }

        $user->update();
        return redirect()->route('users.index'); 

    }

    public function destroy( String $id){

        $user = User::where('id',$id)->first();
        $user->roles()->detach();
        $deleteBranchUser = Userbranch::where('user_id', $id)->delete();
        $user->delete();

        return redirect()->route('users.index');
    }

    public function seacrchroleuser(Request $request){
     $roleid = Roleuser::where('model_id',$request->user)->first();
     $roleuser = Rolesystem::where('id',$roleid->role_id)->first();
     //dd($roleuser->name);
    
     session()->flash('flash.roleuser', $roleuser->name);
     return redirect()->back(); 
    }

    public function searchuser(Request $request){
     $user = User::where('name','LIKE', "%$request->user%")->paginate(5);
     session()->flash('flash.userfound', $user);
     return redirect()->back(); 
    }
}
