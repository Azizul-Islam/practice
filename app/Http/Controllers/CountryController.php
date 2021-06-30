<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::find(1);
        foreach($countries->posts as $post){
            echo $post->title;
        }
    }
}
