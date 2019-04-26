<?php

namespace Via\LaravelSovren;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Sovren
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getAccount()
    {
        $response = $this->client->get('account')->getBody()->getContents();
        return json_decode($response, true);
    }

    public function parse(string $resume)
    {
        try{
        $response = $this->client->post('parser/resume', [
            'json' => [
                'DocumentAsBase64String' => base64_encode($resume)
            ]
        ]);
        } catch (ClientException $e) {
                return json_decode($e->getResponse()->getBody(), true);
        }


        return $this->formatResponse(json_decode($response->getBody()->getContents(), true));
    }

    protected function formatResponse($response): array
    {
        $response = json_decode($response['Value']['ParsedDocument'], true);
        return [
          'StructuredXMLResume' => $response['Resume']['StructuredXMLResume'],
          'NonXMLResume' => $response['Resume']['NonXMLResume'],
          'UserArea' => $response['Resume']['UserArea'],
        ];
    }
}
