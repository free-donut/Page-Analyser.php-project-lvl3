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

    public function __construct($url, $id)
    {
        $this->url = $url;
        $this->id = $id;
    }
    
    public function handle()
    {
        $client = app(Client::class);
        $domain = Domain::find($this->id);
        try {
            $response = $client->request('GET', $this->url, ['http_errors' => false]);
            $domain->status_code = $response->getStatusCode();
            $domain->body = (string) $response->getBody();
            $domain->content_length = $response->getBody()->getSize();

            $document = app(Document::class);
            $document->loadHtml($domain->body);
            $domain->h1 = ($document->has('h1')) ? $document->find('h1')[0]->text() : null;
            $domain->keywords = ($document->has('meta[name=keywords][content]')) ?
                $document->find('meta[name=keywords][content]')[0]->attr('content') : null;
            $domain->description = ($document->has('meta[name=description][content]')) ?
                $document->find('meta[name=description][content]')[0]->attr('content') : null;
            $domain->state = 'parsed';
            $domain->save();
        } catch (ConnectException $e) {
            $domain->state = 'failed';
            $domain->save();
        }
    }
}
