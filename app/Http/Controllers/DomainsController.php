<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Validator;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Psr\Http\Message\ResponseInterface;
use App\Jobs\ParseJob;

class DomainsController extends Controller
{

     /**
     * The GuzzleHttp Client instance.
     */
    protected $client;
    /**
     * Create a new controller instance.
     *
     * @param  Client $client
     * @return void
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Show mine page.
     *
     * @param  Request  $request
     * @return Response
     */
    public function main(Request $request)
    {
        if ($request->has('errors')) {
            $errors = $request->input('errors');
            return view('main', ['errors' => $errors]);
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
            $errors = $validator->errors()->all();
            return redirect()->route('domains.main', ['errors' => $errors]);
        }
        $url = $request->input('url');
        $id = DB::table('Domains')->insertGetId(['url_adress' =>  $url]);

        dispatch(new ParseJob($url, $id));
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
        return view('url_page', ['domain' => $domain]);
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
