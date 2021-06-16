<?php

namespace App\Http\Controllers;

use App\Models\Group;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function index(Request $request){
        $data = Group::orderBy('short_id','asc')->get();
        return view('groups',compact('data'));
    }

    
}
