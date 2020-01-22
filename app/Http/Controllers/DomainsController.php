<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use App\Http\Controllers\Controller;
use App\Jobs\ParseJob;
use App\Domain;
use Validator;

class DomainsController extends Controller
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function main(Request $request)
    {
        if ($request->has('errors')) {
            $errors = $request->input('errors');
            return view('main', ['errors' => $errors]);
        }
        return view('main');
    }

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

        $domain = new Domain();
        $domain->url_adress = $url;
        $domain->state = 'created';
        $domain->save();
        $id = $domain->id;

        dispatch(new ParseJob($url, $id));
        return redirect()->route('domains.show', ['id' => $id]);
    }

    public function show($id)
    {
        $domain = Domain::find($id);
        return view('url_page', ['domain' => $domain]);
    }

    public function index()
    {
        $domains = Domain::paginate(5);
        return view('index', ['domains' => $domains]);
    }
}
