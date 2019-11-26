<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Validator;
use App\Http\Controllers\Controller;

class DomainsController extends Controller
{
    /**
     * Show mine page.
     *
     * @param  Request  $request
     * @return Response
     */
    public function show(Request $request)
    {
        if ($request->has('error')) {
            return view('main')->with('error', 'true');
        }
        return view('main');
    }

    /**
     * Store a new url.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url' => 'required|url|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('main', ['error' => 'true']);
        }

        $url = $request->input('url');
        $id = DB::table('Domains')->insertGetId(
            ['name' => $url]
        );
        return redirect("domains/$id");
    }
}
