<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CellarsController extends Controller
{
    //
    public function userCellars()
    {
        $userCellars = DB::table('cellars')
            ->where('users_id', Auth::id())
            ->get();
        return $userCellars;
    }
    public function userCellarContents($id)
    {
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
            ->select('cellar_contents.*',
                        DB::raw('IF(cellar_contents.wine_sources_id = 1, saq_wines.name, personal_wines.name) as wine_name'),
                        DB::raw('IF(cellar_contents.wine_sources_id = 1, saq_wines.price, personal_wines.price) as price'),
                        DB::raw('IF(cellar_contents.wine_sources_id = 1, saq_wines.url_image, personal_wines.url_image) as url_image'),
                        DB::raw('IF(cellar_contents.wine_sources_id = 1, saq_wines.country, personal_wines.country) as country'),
                        DB::raw('IF(cellar_contents.wine_sources_id = 1, saq_wines.region, personal_wines.region) as region'),
                        DB::raw('IF(cellar_contents.wine_sources_id = 1, saq_wines.types_id, personal_wines.types_id) as types_id'))
            ->get();
            $userCellarContents = $userCellarContents->map(function ($item) {
                $item->type = DB::table('types')->where('id', $item->types_id)->value('type');
                return $item;
            });

        return $userCellarContents;
    }
}
