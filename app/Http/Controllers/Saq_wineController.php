<?php

namespace App\Http\Controllers;

use App\Models\Saq_wine;
use Illuminate\Http\Request;
use Inertia\Inertia;

class Saq_wineController extends Controller
{
    //montrer tout les vins
    public function index(){
        $wines = Saq_wine::join('types', 'saq_wines.types_id', '=', 'types.id')
            ->select('saq_wines.*', 'types.type')
            ->orderBy('name')
            ->paginate(20);

        $search = '';

        return Inertia::render('AddWineToCellar', [
            'wines' => $wines, 
            'search' => $search,
        ]);
    }

    //rechercher dans les vins de la SAQ
    public function search($search){
        $wines = Saq_wine::join('types', 'saq_wines.types_id', '=', 'types.id')
            ->select('saq_wines.*', 'types.type')
            ->where('name', 'like', "%$search%")
            ->orderBy('name')
            ->paginate(20);

        return Inertia::render('AddWineToCellar', [
            'wines' => $wines, 
            'search' => $search,
        ]);
    }
}
