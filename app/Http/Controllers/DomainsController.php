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
    public function main(Request $request)
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
            return redirect()->route('domains.main', ['error' => 'true']);
        }

        $url = $request->input('url');
        $id = DB::table('Domains')->insertGetId(
            ['name' => $url]
        );
        return redirect()->route('domains.show', ['id' => $id]);
    }

    /**
     * Show a url.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $domains = DB::table('Domains')->get();
        $domain = DB::table('Domains')->where('id', $id)->first();
        $count = DB::table('Domains')->count();

        $name = $domain->name;
        $updated_at = $domain->updated_at;
        $created_at = $domain->created_at;
        return view('url_page', ['url' => $name]);
    }

    /**
     * Show a list of url.
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
        $domains = DB::table("Domains")->paginate(3);
        return view('index', ['domains' => $domains]);
    }
}
