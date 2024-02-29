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
use Illuminate\Support\Facades\Session;

class CellarContentController extends Controller
{
    /**
     * fonction pour afficher les contenues du cellier de l'utilisateur
     */
    public function index()
    {
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
            $item->grape_varieties =  Saq_wine::where('id', $item->saq_wines_id)->value('grape_varieties') ?? Personal_wine::where('id', $item->personal_wines_id)->value('grape_varieties');
            $item->format =  Saq_wine::where('id', $item->saq_wines_id)->value('format') ?? Personal_wine::where('id', $item->personal_wines_id)->value('format');
            $item->degree_alcohol =  Saq_wine::where('id', $item->saq_wines_id)->value('degree_alcohol') ?? Personal_wine::where('id', $item->personal_wines_id)->value('degree_alcohol');
            $item->sugar_content =  Saq_wine::where('id', $item->saq_wines_id)->value('sugar_content') ?? Personal_wine::where('id', $item->personal_wines_id)->value('sugar_content');
            $item->description =  Saq_wine::where('id', $item->saq_wines_id)->value('description') ?? Personal_wine::where('id', $item->personal_wines_id)->value('description');
            $item->types_id =  Saq_wine::where('id', $item->saq_wines_id)->value('types_id') ?? Personal_wine::where('id', $item->personal_wines_id)->value('types_id');
            $item->type = Type::where('id', $item->types_id)->value('type');
            return $item;
        });
        //pagination
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $currentPageSearchResults = $wines->slice(($currentPage - 1) * $perPage, $perPage)->values()->all();
        $wines = new LengthAwarePaginator($currentPageSearchResults, count($wines), $perPage);
        $wines->setPath(request()->url());

        //retourner la vue
        return Inertia::render('Dashboard', [
            'userCellar' => $userCellar,
            'cellarContents' => $cellarContents,
            'wines' => $wines,
        ]);
    }
    /**
     * fonction pour sauvegarder un vin dans le cellier de l'utilisateur (à terminer)
     */
    public function store(Request $request)
    {
        //récupérer l'id de l'utilisateur
        $user = Auth::id();
        //récupérer le cellier de l'utilisateur
        $userCellar = Cellars::where('user_id', $user)->get();
        //validation des champs
        $request->validate([
            'quantity' => 'required',
            'notes' => 'max:100',
            'saq_wines_id' => 'numeric',
        ]);
        $userCellarContents = Cellar_content::where('cellars_id', $userCellar[0]->id)->get();
        //vérifier si le vin est déjà dans le cellier
        foreach ($userCellarContents as $userCellarContent) {
            if ($userCellarContent->saq_wines_id == $request->saq_wines_id) {
                Cellar_content::where('saq_wines_id', $request->saq_wines_id)->update([
                    'quantity' => $userCellarContent->quantity + $request->quantity,
                ]);
                return Inertia::render('AddWineToCellar', [
                    'success' => 'Le vin a été ajouté à votre cellier',
                ]);
            }
        }


        //ajout du vin dans le cellier de l'utilisateur
        Cellar_content::create([
            'cellars_id' => $userCellar[0]->id,
            'saq_wines_id' => $request->saq_wines_id,
            'quantity' => $request->quantity,
            'wine_sources_id' => 1,
            'purchase_date' => date('Y-m-d H:i:s'),
        ]);

        return Inertia::render('AddWineToCellar', [
            'success' => 'Le vin a été ajouté à votre cellier',
        ]);
    }
    /**
     * fonction pour modifier la quantité d'un vin dans le cellier de l'utilisateur
     */
    public function update(Request $request) {
        //récupérer l'id de l'utilisateur
        $user = Auth::id();
        //récupérer le cellier de l'utilisateur
        $userCellar = Cellars::where('user_id', $user)->get();
        //validation des champs
        $request->validate([
            'quantity' => 'required|min:1',
            'id' => 'numeric',
        ]);
        //retrouver le vin dans le cellier de l'utilisateur
        $userCellarContents = Cellar_content::where('cellars_id', $userCellar[0]->id)->get();
        foreach ($userCellarContents as $userCellarContent) {
            if ($userCellarContent->id == $request->id) {
                Cellar_content::where('id', $request->id)->update([
                    'quantity' => $request->quantity,

                ]);
                return Inertia::render('dashboard', [
                    'success' => 'Le vin a été modifié dans votre cellier',
                ]);
            }
        }
    }
    /**
     * fonction pour supprimer un vin du cellier de l'utilisateur
     */
    public function destroy($id) {
        //récupérer l'id de l'utilisateur
        $user = Auth::id();
        //récupérer le cellier de l'utilisateur
        $userCellar = Cellars::where('user_id', $user)->get();
        //supprimer le vin du cellier de l'utilisateur
        $wine = Cellar_content::where('id', $id)->delete();
        $message = 'Le vin a été supprimé de votre cellier';
        Session::flash('success_message', $message);
        return Redirect::route('dashboard');
    }
}
