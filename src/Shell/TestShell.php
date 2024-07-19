<?php

namespace App\Shell;

use App\Model\Table\ApiTable;
use Cake\Console\Shell;

class TestShell extends Shell
{
    public function main()
    {
        $apiKey = ApiTable::getApi();
        $uri = 'http://api.football-data.org/v4/competitions/';
        $reqPrefs['http']['method'] = 'GET';
        $reqPrefs['http']['header'] = 'X-Auth-Token: '.$apiKey; // Înlocuiți cu cheia API reală

        $stream_context = stream_context_create($reqPrefs);
        $response = file_get_contents($uri, false, $stream_context);
        $standings = json_decode($response);

        var_dump($standings->competitions[0]);die();
    }
}