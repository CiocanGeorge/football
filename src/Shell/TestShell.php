<?php

namespace App\Shell;

use Cake\Console\Shell;

class TestShell extends Shell
{
    public function main()
    {
        $uri = 'http://api.football-data.org/v4/competitions/';
        $reqPrefs['http']['method'] = 'GET';
        $reqPrefs['http']['header'] = 'X-Auth-Token: b10aca13f2654a608ccf860165b9b898'; // Înlocuiți cu cheia API reală

        $stream_context = stream_context_create($reqPrefs);
        $response = file_get_contents($uri, false, $stream_context);
        $standings = json_decode($response);

        var_dump($standings->competitions[0]);die();
    }
}