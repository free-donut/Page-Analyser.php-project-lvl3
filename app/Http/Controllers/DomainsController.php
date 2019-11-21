<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DomainsController extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $url = $request->input('url');

        //DB::table('Domains')->insert(
        //    ['name' => $url]
        //);
        $id = DB::table('Domains')->insertGetId(
            ['name' => $url]
        );

        //DB::insert('insert into Domains (url) values (?)', [$url]);
        return redirect("domains/$id");
        //return $url;

        //
    }
}
