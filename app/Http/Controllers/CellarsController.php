<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Cellars;

class CellarsController extends Controller
{

     /**
    * Mise à jour des informations du cellier de l'utilisateur.
    */
    public function update(Request $request, Cellars $cellar)
    {
        //la validation des champs
        $request->validate([
            'name' => 'max:50',
            'description' => 'max:100',
        ]);

        //la mise à jour
        $cellar->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        //le retour vers la page précédente
        return Redirect::back();
    }


    /**
     * fonction qui retourne les celliers de l'utilisateur
     */
    public function userCellars()
    {
        $userCellars = DB::table('cellars')
            ->where('user_id', Auth::id())
            ->get();
        return $userCellars;
    }

    /**
     * fonction qui retourne les vins dans un cellier de l'utilisateur
     */

    public function userCellarContents($id)
    {
        $user = Auth::id();
        //récupérer les celliers de l'utilisateur
        $userCellars = DB::table('cellars')
            ->where('user_id', $user)
            ->get();
        // récupérer les vins dans le cellier de l'utilisateur
        foreach ($userCellars as $cellar) {
            // si le cellier correspond à l'id
            if ($cellar->id == $id) {
                // vins sources (SAQ ou personnels)
                $userCellarContents = DB::table('cellar_contents')
                    ->where('cellars_id', $id)
                    ->leftJoin('wine_sources', 'cellar_contents.wine_sources_id', '=', 'wine_sources.id')
                    ->leftJoin('saq_wines', function ($join) {
                        $join->on('cellar_contents.saq_wines_id', '=', 'saq_wines.id')
                            ->where('cellar_contents.wine_sources_id', 1);
                    })
                    ->leftJoin('personal_wines', function ($join) {
                        $join->on('cellar_contents.personal_wines_id', '=', 'personal_wines.id')
                            ->where('cellar_contents.wine_sources_id', 2);
                    })
                    // sélection des colonnes pour les vins sources (SAQ ou personnels)
                    ->select('cellar_contents.*',
                        DB::raw('IF(cellar_contents.wine_sources_id = 1, saq_wines.name, personal_wines.name) as wine_name'),
                        DB::raw('IF(cellar_contents.wine_sources_id = 1, saq_wines.price, personal_wines.price) as price'),
                        DB::raw('IF(cellar_contents.wine_sources_id = 1, saq_wines.url_image, personal_wines.url_image) as url_image'),
                        DB::raw('IF(cellar_contents.wine_sources_id = 1, saq_wines.country, personal_wines.country) as country'),
                        DB::raw('IF(cellar_contents.wine_sources_id = 1, saq_wines.region, personal_wines.region) as region'),
                        DB::raw('IF(cellar_contents.wine_sources_id = 1, saq_wines.types_id, personal_wines.types_id) as types_id'),
                        DB::raw('IF(cellar_contents.wine_sources_id = 1, saq_wines.grape_varieties, personal_wines.grape_varieties) as grape_varieties'))
                    ->get();
                // ajout des colonnes type et nom du cellier
                $userCellarContents = $userCellarContents->map(function ($item) {
                    $item->type = DB::table('types')->where('id', $item->types_id)->value('type');
                    return $item;
                });
                return $userCellarContents;
            }
        }

    }

    /**
     * fonction qui cherche un vin dans un cellier de l'utilisateur par nom
     */
    public function searchWineInUserCellars(Request $request) {
        $search = $request->search;
        $user = Auth::id();
        $userCellarContents = [];
        //récupérer les celliers de l'utilisateur
        $userCellars = DB::table('cellars')
            ->where('user_id', $user)
            ->get();
        //récupérer les vins dans les celliers de l'utilisateur
        foreach ($userCellars as $cellar) {
            $contents = DB::table('cellar_contents')
                ->where('cellars_id', $cellar->id)
                // vins sources
                ->leftJoin('wine_sources', 'cellar_contents.wine_sources_id', '=', 'wine_sources.id')
                // vins SAQ
                ->leftJoin('saq_wines', function ($join) {
                    $join->on('cellar_contents.saq_wines_id', '=', 'saq_wines.id')
                        ->where('cellar_contents.wine_sources_id', 1);
                })
                // vins personnels
                ->leftJoin('personal_wines', function ($join) {
                    $join->on('cellar_contents.personal_wines_id', '=', 'personal_wines.id')
                        ->where('cellar_contents.wine_sources_id', 2);
                })
                // sélection des colonnes
                ->select('cellar_contents.*',
                    DB::raw('IF(cellar_contents.wine_sources_id = 1, saq_wines.name, personal_wines.name) as wine_name'),
                    DB::raw('IF(cellar_contents.wine_sources_id = 1, saq_wines.price, personal_wines.price) as price'),
                    DB::raw('IF(cellar_contents.wine_sources_id = 1, saq_wines.url_image, personal_wines.url_image) as url_image'),
                    DB::raw('IF(cellar_contents.wine_sources_id = 1, saq_wines.country, personal_wines.country) as country'),
                    DB::raw('IF(cellar_contents.wine_sources_id = 1, saq_wines.region, personal_wines.region) as region'),
                    DB::raw('IF(cellar_contents.wine_sources_id = 1, saq_wines.types_id, personal_wines.types_id) as types_id'),
                    DB::raw('IF(cellar_contents.wine_sources_id = 1, saq_wines.grape_varieties, personal_wines.grape_varieties) as grape_varieties'))
                // recherche par nom de vin dans les vins SAQ et personnels
                ->where('saq_wines.name', 'like', '%' . $search . '%')
                ->orWhere('personal_wines.name', 'like', '%' . $search . '%')
                ->get();
                // ajout des colonnes type et nom du cellier
            $contents = $contents->map(function ($item) {
                $item->type = DB::table('types')->where('id', $item->types_id)->value('type');
                $item->cellar_name = DB::table('cellars')->where('id', $item->cellars_id)->value('name');
                return $item;
            });
            $userCellarContents = array_merge($userCellarContents, $contents->toArray());
        }
        return $userCellarContents;
    }
}
