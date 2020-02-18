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

class HomePageController extends Controller
{

    public function create(Request $request)
    {
        $errors = $request->query('errors') ?: null;
        return view('domains/new', compact('errors'));
    }
}
