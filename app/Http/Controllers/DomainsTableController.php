<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;


use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DomainsTableController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @param  int  $id
     * @return Response
     */
    public function index($id)
    {
        $domains = DB::table('Domains')->get();
        $domain = DB::table('Domains')->where('id', $id)->first();
        $count = DB::table('Domains')->count();

        //return $count;
        $name = $domain->name;
        $updated_at = $domain->updated_at;
        $created_at = $domain->created_at;

		return $domain->name;

        //return view('user.index', ['users' => $users]);
    }
}
