<?php

namespace App\Http\Controllers;

use App\Models\Saq_wine;
use Illuminate\Http\Request;
use Inertia\Inertia;

class Saq_wineController extends Controller
{
    //
    public function index(){
        $wines = Saq_wine::paginate(20);

/*         dd($wines); */

        return Inertia::render('AddWineToCellar', [
            'wines' => $wines,
        ]);
    }

}
