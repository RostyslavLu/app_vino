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
        $search = '';

        return Inertia::render('AddWineToCellar', [
            'wines' => $wines, 
            'search' => $search, 
        ]);
    }

    //rechercher dans les vins de la SAQ
    public function search($search){
        $wines = Saq_wine::where('name', 'like', "%$search%")->paginate(20);
        return ['wines' => $wines, 'search' => $search];
    }

    //une fonction pour un champ de recherche vidé
    public function emptySearch(){
        $wines = Saq_wine::paginate(20);
        return ['wines' => $wines, 'search' => ''];
    }

}
