<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use App\Jobs\ParseJob;
use App\Domain;
use Validator;

class DomainController extends Controller
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url' => 'required|url|max:255',
        ]);
        
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return redirect()->route('home', compact('errors'));
        }
        $url = $request->input('url');

        $domain = new Domain();
        $domain->url_adress = $url;
        $domain->state = 'created';
        $domain->save();
        $id = $domain->id;

        dispatch(new ParseJob($url, $id));
        return redirect()->route('domains.show', compact('id'));
    }

    public function show($id, Request $request)
    {

        $domain = Domain::find($id);
        if (!$domain) {
            abort(404);
        }
        return view('domains/show', compact('domain'));
    }

    public function index()
    {
        $domains = Domain::paginate(3);
        return view('domains/index', compact('domains'));
    }
}
