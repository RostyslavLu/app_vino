<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->query('query');

        $results = DB::table('Saq_wines')
            ->where('name', 'like',   $query .'%' )
            ->get();

        return response()->json($results);

    }
}
