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
    public function search($filter, $search=''){



        $query = Saq_wine::join('types', 'saq_wines.types_id', '=', 'types.id')
            ->select('saq_wines.*', 'types.type')
            ->where('name', 'like', "%$search%");

            // Ajouter la recherche et le filtre de façon conditionelle a la requete
            if (!is_null($search)) {
                $query->where('name', 'like', "%$search%");
            }
            if ($filter !== 'all') {
                $query->where('type', '=', $filter);
            }
            //mettre en ordre alphabetique
            $query->orderBy('name');

            //completer la requete en ajoutant la pagination
            $wines = $query->paginate(20); 

/*         $wines = Saq_wine::join('types', 'saq_wines.types_id', '=', 'types.id')
            ->select('saq_wines.*', 'types.type')
            ->where('name', 'like', "%$search%")
            ->orderBy('name')
            ->paginate(20); */

        return Inertia::render('AddWineToCellar', [
            'wines' => $wines, 
            'search' => $search,
            'filter' => $filter,
        ]);
    }
}
