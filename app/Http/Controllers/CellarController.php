<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Cellar;

use Illuminate\Http\Request;

class CellarController extends Controller
{
    /**
    * Update the user's cellar information.
    */
    public function update(Request $request, Cellar $cellar)
    {
        //validate the name and description fields
        $request->validate([
            'name' => 'max:35',
            'description' => 'max:200',
        ]);
        //update them
        $cellar->update([
            'name' => $request->name,
            'description' => $request->description
        ]);
        return Redirect::back();
        //return Redirect::route('profile.edit');
    }
}
