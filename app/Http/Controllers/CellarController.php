<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

class CellarController extends Controller
{
    /**
    * Update the user's cellar information.
    */
    public function update($request)
    {
        //validate the name and description fields
        //update them
        return Redirect::route('profile.edit');
    }
}
