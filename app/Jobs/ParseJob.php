<?php

namespace App\Jobs;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use DiDom\Document;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ConnectException;

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
        //try {
                $response = $client->request('GET',  $this->url, ['http_errors' => false]);
                $statusCode = $response->getStatusCode();
                $contentLength = $response->getBody()->getSize();
                $body = (string) $response->getBody();

                $document = app(Document::class);
                $document->loadHtml($body);
                $h1 = ($document->has('h1')) ? $document->find('h1')[0]->text() : null;
                $keywords = ($document->has('meta[name=keywords][content]')) ?  $document->find('meta[name=keywords][content]')[0]->attr('content') : null;
                $description = ($document->has('meta[name=description][content]')) ?  $document->find('meta[name=description][content]')[0]->attr('content') : null;

                DB::table('Domains')
                ->where('id', $this->id)
                ->update(
                    ['status_code' => $statusCode,
                    'content_length' => $contentLength,
                    'body' => $body,
                    'h1' => $h1,
                    'keywords' => $keywords,
                    'description' => $description,
                    'updated_at' => time()]
                );
            //} catch (ConnectException $e) {
                //fail
            //}    
    }
}
