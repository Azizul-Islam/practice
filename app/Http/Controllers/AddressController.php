<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AddressController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(1);
        echo $user->address;
    }
    public function store()
    {
        $user =User::findOrfail(1);
        // $user->full_name = 'Azizul Islam';
        // $user->email = 'cseazizul@gmail.com';
        // $user->password = Hash::make('password');
        // $user->address = '48/i West rajabazar,Dhaka 1213';
        // $user->save();

        $address = new Address(['name' => '5000000/i West rajabazar,Dhaka 1213']);

        $user->address()->save($address);
        
    }

    public function update()
    {
        $address = Address::where('user_id',1)->first();
        $address->name = "488888/i update location";
        $address->save();
    }

    public function destroy()
    {
        $user = User::findOrFail(1);
        $user->address()->delete();
    }

    public function getUser($id)
    {
        $address = Address::find(3);
        return $address->user->full_name;
    }

    public function getAddress()
    {
        $user = User::find(1);
        foreach($user->addresses as $address){
            echo $address->name."<br>";
        }
    }
}
