<?php

namespace App\Shell;

use Cake\Console\Shell;
use Cake\ORM\TableRegistry;
use Exception;

class GetTeamShell extends Shell
{

    public function getTeam()
    {
        $uri = 'http://api.football-data.org/v4/teams';
        $reqPrefs['http']['method'] = 'GET';
        $reqPrefs['http']['header'] = 'X-Auth-Token: b10aca13f2654a608ccf860165b9b898'; // Înlocuiți cu cheia API reală

        $stream_context = stream_context_create($reqPrefs);
        $response = file_get_contents($uri, false, $stream_context);
        $teamsData = json_decode($response)->teams;

        $teamsTable = TableRegistry::getTableLocator()->get('Teams');

        foreach ($teamsData as $data) {
            $team = $teamsTable->findOrCreate([
                'name' => $data->name
            ], function ($entity) use ($data) {
                $entity->id = $data->id;
                $entity->shortName = $data->shortName;
                $entity->tla = $data->tla;
                $entity->crest = $data->crest;
                $entity->address = $data->address;
                $entity->website = $data->website;
                $entity->founded = $data->founded;
                $entity->clubColors = $data->clubColors;
                $entity->venue = $data->venue;
                $entity->lastUpdated = date('Y-m-d H:i:s', strtotime($data->lastUpdated));
            });

            if ($teamsTable->save($team)) {
                $this->out('Echipa ' . $data->name . ' a fost salvată cu succes.');
            } else {
                $this->err('Nu s-a putut salva echipa ' . $data->name);
            }
        }

        $this->out('Datele echipelor au fost inserate cu succes.');
    }
}