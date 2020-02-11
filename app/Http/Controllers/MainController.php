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

class MainController extends Controller
{

    public function main(Request $request)
    {
        if ($request->has('errors')) {
            $errors = $request->input('errors');
            return view('main', ['errors' => $errors]);
        }
        return view('main');
    }
}
