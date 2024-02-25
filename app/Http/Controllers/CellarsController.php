<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Cellars;
use App\Models\Cellar_content;
use App\Models\Saq_wine;
use App\Models\Type;
use App\Models\Personal_wine;
use Inertia\Inertia;
use Illuminate\Pagination\LengthAwarePaginator;

class CellarsController extends Controller
{
    /**
     * fonction pour afficher les celliers et les vins de l'utilisateur.
     */
    public function index(){
        //récupérer l'id de l'utilisateur
        $user = Auth::id();
        //récupérer les celliers de l'utilisateur
        $userCellar = Cellars::where('user_id', $user)->get();
        //récupérer les vins dans le cellier de l'utilisateur
        $cellarContents = Cellar_content::where('cellars_id', $userCellar[0]->id)->get();
        // ajout des colonnes type, nom du vin, url de l'image, pays et région etc
        $wines = $cellarContents->map(function ($item) {
            $item->name =  Saq_wine::where('id', $item->saq_wines_id)->value('name') ?? Personal_wine::where('id', $item->personal_wines_id)->value('name');
            $item->url_image =  Saq_wine::where('id', $item->saq_wines_id)->value('url_image') ?? Personal_wine::where('id', $item->personal_wines_id)->value('url_image');
            $item->country =  Saq_wine::where('id', $item->saq_wines_id)->value('country') ?? Personal_wine::where('id', $item->personal_wines_id)->value('country');
            $item->region =  Saq_wine::where('id', $item->saq_wines_id)->value('region') ?? Personal_wine::where('id', $item->personal_wines_id)->value('region');
            $item->types_id =  Saq_wine::where('id', $item->saq_wines_id)->value('types_id') ?? Personal_wine::where('id', $item->personal_wines_id)->value('types_id');
            $item->type = Type::where('id', $item->types_id)->value('type');
            return $item;
        });
        //pagination

        //retourner la vue
        return Inertia::render('Dashboard', [
            'userCellar' => $userCellar,
            'cellarContents' => $cellarContents,
            'wines' => $wines,
        ]);
    }
     /**
    * Mise à jour des informations du cellier de l'utilisateur.
    */
    public function update(Request $request, Cellars $cellar)
    {
        //la validation des champs
        $request->validate([
            'name' => 'max:50|required',
        ]);
        //la mise à jour
        $cellar->update([
            'name' => $request->name,
        ]);

        //le retour vers la page précédente
        return Redirect::back();
    }
}
