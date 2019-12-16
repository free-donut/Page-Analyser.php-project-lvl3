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
    protected $id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($url, $id)
    {
        $this->url = $url;
        $this->id = $id;
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
        DB::table('Domains')
        ->where('id', $this->id)
        ->update(
            ['status_code' => $responseCode,
            'content_length' => $contentLength,
            'body' => $body]
        );
    }
}
