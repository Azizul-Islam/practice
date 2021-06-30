<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function store()
    {
        $staff = Staff::find(1);
        $staff->photos()->create(['path'=>'image1.jpg']);
    }

    public function index()
    {
        $staff = Staff::find(1);
        foreach($staff->photos as $photo){
            echo $photo->path."<br>";
        }
    }

    public function update()
    {
        $staff = Staff::find(1);
        $photo = $staff->photos()->whereId(1)->first();
        $photo->path = 'update.jpg';
        $photo->save();
    }

    public function delete()
    {
        $staff = Staff::find(1);
        $staff->photos()->whereId(1)->delete();
    }
}
