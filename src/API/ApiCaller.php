<?php

namespace App\API;

use Cake\Http\Client;

class ApiCaller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getEncounterDatas($eventId)
    {
        $url = 'http://testing.canne.tv/replay/api/competitions/' . $eventId . '/encounters';
        return $this->callApi($url);
    }

    public function getEncounterDetails($encounterId)
    {
        $url = 'http://testing.canne.tv/replay/api/encounters/' . $encounterId;
        return $this->callApi($url);
    }

    protected function callApi($url)
    {
        $response = $this->client->get($url);
        if ($response->isOk()) {
            return $response->getJson();
        }
        // Gérer les erreurs si nécessaire
        return null;
    }
}
