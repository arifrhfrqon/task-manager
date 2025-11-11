<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {
    public function index() 
    { 
        $users = User::with('role')->get(); 
        return view('users.index',compact('users')); 
    }

    public function create() 
    { 
        $roles = Role::all(); 
        return view('users.create',compact('roles')); 
    }

    public function store(Request $r) {
        $r->validate(['name'=>'required','email'=>'required|email|unique:users','password'=>'required','role_id'=>'nullable|exists:roles,id']);
        User::create(['name'=>$r->name,'email'=>$r->email,'password'=>Hash::make($r->password),'role_id'=>$r->role_id]);
        return redirect()->route('users.index')->with('success','User dibuat.');
    }

    public function edit(User $user)
    { 
        $roles = Role::all(); 
        return view('users.edit',compact('user','roles')); 
    }
    
    public function update(Request $r, User $user){
        $r->validate(['name'=>'required
        ','email'=>'required|email|unique:users,email,'.$user->id,'role_id'=>'nullable|exists:roles,id']);
        $data = $r->only(['name','email','role_id']);
        if ($r->filled('password')) $data['password'] = Hash::make($r->password);
        $user->update($data);
        return redirect()->route('users.index')->with('success','User diperbarui.');
    }

    public function destroy(User $user)
    { 
        $user->delete(); 
        return back()->with('success','User dihapus.'); 
    }
}
