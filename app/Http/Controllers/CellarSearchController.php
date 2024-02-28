<?php

namespace App\Http\Controllers;
use App\Models\Cellar_content;
use Illuminate\Support\Facades\Auth;
use App\Models\Cellars;
use Inertia\Inertia;

use Illuminate\Http\Request;

class CellarSearchController extends Controller
{
    //
    //rechercher dans les vins de la SAQ
    public function search($search){
        //récupérer l'id de l'utilisateur
        $user = Auth::id();
        //récupérer les celliers de l'utilisateur
        $userCellar = Cellars::where('user_id', $user)->get();
        //récupérer les vins dans le cellier de l'utilisateur
   /*      $cellarContents = Cellar_content::where('cellars_id', $userCellar[0]->id)->get(); */

        $cellarContents = Cellar_content::join('types', $userCellar[0]->id)->get()

        $wines = Cellar_content::join('types', 'saq_wines.types_id', '=', 'types.id')
            ->select('saq_wines.*', 'types.type')
            ->where('name', 'like', "%$search%")
            ->paginate(20);

        return Inertia::render('AddWineToCellar', [
            'wines' => $wines, 
            'search' => $search,
        ]);

         //retourner la vue
         return Inertia::render('Dashboard', [
            'userCellar' => $userCellar,
            'cellarContents' => $cellarContents,
            'wines' => $wines,
        ]);
    }

}
