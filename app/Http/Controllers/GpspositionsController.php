<?php

namespace App\Http\Controllers;

use App\Models\Gpsposition;
use Illuminate\Http\Request;

class GpspositionsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Gpsposition::class);

        $search = $request->get('search', '');

        $gpspositions = Gpsposition::search($search)
            ->latest()
            ->paginate(5);

        return view('app.gpspositions.index', compact('gpspositions', 'search'));
    }

   
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Gpsposition $gpsposition
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Gpsposition $gpsposition)
    {
        $this->authorize('view', $gpsposition);

        return view('app.gpspositions.show', compact('gpsposition'));
    }

   
}
