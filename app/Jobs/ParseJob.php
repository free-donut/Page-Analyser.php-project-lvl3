<?php

namespace App\Jobs;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use DiDom\Document;
use Illuminate\Http\Response;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\ConnectException;
use App\Domain;

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
        try {
            $response = $client->request('GET', $this->url, ['http_errors' => false]);
            $statusCode  = $response->getStatusCode();
            $body = (string) $response->getBody();
            $contentLength = $response->getBody()->getSize();

            $document = app(Document::class);
            $document->loadHtml($body);
            $h1 = ($document->has('h1')) ? $document->find('h1')[0]->text() : null;
            $keywords = ($document->has('meta[name=keywords][content]')) ? $document->find('meta[name=keywords][content]')[0]->attr('content') : null;
            $description = ($document->has('meta[name=description][content]')) ? $document->find('meta[name=description][content]')[0]->attr('content') : null;

            $domain = Domain::find($this->id);
            $domain->status_code = $statusCode;
            $domain->content_length = $contentLength;
            $domain->body = $body;
            $domain->h1 = $h1;
            $domain->keywords = $keywords;
            $domain->description = $description;
            $domain->state = 'parsed';
            $domain->save();
        } catch (ConnectException $e) {
            $domain = Domain::find($this->id);
            $domain->state = 'failed';
            $domain->save();
        }
    }
}
