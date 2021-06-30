<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index($id)
    {
        $user = User::find($id);
        foreach($user->roles as $role){
            echo $role->name;
        }

    }
    public function store()
    {
        $user = User::find(1);
        $role = new Role(['name'=>"admin"]);
        $user->roles()->save($role);
    }

    public function update($id)
    {
        $user = User::find($id);

        if($user->has('roles')){
            foreach($user->roles as $role){
                if($role->name == 'admin'){
                    $role->name = 'author';
                    $role->save();
                }
            }
        }
    }

    public function delete($id)
    {
        $user = User::find($id);
        foreach($user->roles as $role){
            $role->whereId(1)->delete();
        }
    }

    public function attach($id)
    {
        $user = User::find($id);
        $user->roles()->attach(3);

    }

    public function detach($id)
    {
        $user = User::find($id);
        $user->roles()->detach(2);

    }
    
}
