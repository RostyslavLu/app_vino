<?php

namespace App\Http\Controllers;
use App\Models\Cellar_content;
use Illuminate\Support\Facades\Auth;
use App\Models\Cellars;
use Inertia\Inertia;

use Illuminate\Http\Request;

class CellarSearchController extends Controller
{
    //rechercher dans les vins de la SAQ
    public function search($search){
        //récupérer l'id de l'utilisateur
        $user = Auth::user();

        //récupérer les celliers de l'utilisateur
        $userCellar = Cellars::where('user_id', $user->id)->get();

        //récupérer le premier cellier de l'utilisateur
        $firstCellarId = $user->cellars()->orderBy('created_at')->first()->id;

        //requete sql
        $cellarContents = Cellar_content::where('cellars_id', $firstCellarId)
            ->join('saq_wines', 'cellar_contents.saq_wines_id', '=', 'saq_wines.id')
            ->join('types', 'saq_wines.types_id', '=', 'types.id')
            ->select('saq_wines.*', 'types.type', 'cellar_contents.quantity')
            ->where('name', 'like', "%$search%")
/*             ->where('type', '=', 'blanc') */
            ->paginate(10);

        //retourner la vue
        return Inertia::render('Dashboard', [
            'userCellar' => $userCellar,
            'wines' => $cellarContents,
            'search' => $search,
        ]);
    }
}
