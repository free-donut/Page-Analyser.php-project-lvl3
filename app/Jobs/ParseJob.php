<?php

namespace App\Jobs;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\DB;

class ParseJob extends Job
{
    protected $url;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()

    {
        $client = app(Client::class);
        $response = $client->request('GET',  $this->url);
        $contentLength = $response->getBody()->getSize();
        $responseCode = $response->getStatusCode();
        $body = $response->getBody();

        $id = DB::table('Domains')->insertGetId(
            ['name' =>  $this->url,
            'status_code' => $responseCode,
            'content_length' => $contentLength,
            'body' => $body]
        );
    }
}
