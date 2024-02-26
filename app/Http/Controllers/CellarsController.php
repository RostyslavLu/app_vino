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
