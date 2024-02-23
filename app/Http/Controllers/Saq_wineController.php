<?php

namespace App\Http\Controllers;

use App\Models\Saq_wine;
use Illuminate\Http\Request;
use Inertia\Inertia;

class Saq_wineController extends Controller
{
    //montrer tout les vins
    public function index(){
        $wines = Saq_wine::paginate(20);

        return Inertia::render('AddWineToCellar', [
            'wines' => $wines,
        ]);
    }

    //rechercher dans les vins de la SAQ
    public function search(Request $request, $search)
    {
        $wines = Saq_wine::where('name', 'like', "%$search%")->get();

        return inertia('AddWineToCellar', [
            'wines' => $wines,
        ]);
    }

}
