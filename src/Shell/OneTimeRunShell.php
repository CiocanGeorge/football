<?php

namespace App\Shell;

use Cake\Console\Shell;
use Cake\ORM\TableRegistry;
use Exception;

class OneTimeRunShell extends Shell
{

    public function addCompetitions()
    {
        $uri = 'http://api.football-data.org/v4/competitions/';
        $reqPrefs['http']['method'] = 'GET';
        $reqPrefs['http']['header'] = 'X-Auth-Token: b10aca13f2654a608ccf860165b9b898'; // Înlocuiți cu cheia API reală

        $stream_context = stream_context_create($reqPrefs);
        $response = file_get_contents($uri, false, $stream_context);
        $competitions = json_decode($response)->competitions;

        $areasTable = TableRegistry::getTableLocator()->get('Areas');
        $currentSeasonsTable = TableRegistry::getTableLocator()->get('CurrentSeasons');
        $competitionsTable = TableRegistry::getTableLocator()->get('Competitions');

        foreach ($competitions as $competition) {
            try
            {
            // Adăugarea sau găsirea zonei
            $area = $areasTable->findOrCreate([
                'id' => $competition->area->id
            ], function ($entity) use ($competition) {
                $entity->name = (string)($competition->area->name ?? '');
                $entity->code = (string)($competition->area->code ?? '');
                $entity->flag = (string)($competition->area->flag ?? '');
            });

            // Adăugarea sau găsirea sezonului curent
            $currentSeason = $currentSeasonsTable->findOrCreate([
                'id' => $competition->currentSeason->id
            ], function ($entity) use ($competition) {
                $entity->start_date = (string)($competition->currentSeason->startDate ?? null);
                $entity->end_date = (string)($competition->currentSeason->endDate ?? null);
                $entity->current_matchday = (int)($competition->currentSeason->currentMatchday ?? null);
                $entity->winner = $competition->currentSeason->winner->name ?? null;
            });


                $competitionEntity = $competitionsTable->findOrCreate([
                    'id' => $competition->id
                ], function ($entity) use ($competition) {
                    $entity->area_id = $competition->area->id ?? null;
                    $entity->name = $competition->name ?? null;
                    $entity->code = $competition->code ?? null;
    
                    $entity->type = $competition->type ?? null;
                    $entity->emblem = $competition->emblem ?? null;
    
                    $entity->plan = $competition->plan ?? null;
                    $entity->current_season_id = $competition->currentSeason->id ?? null;
    
                    $entity->number_of_available_seasons = $competition->numberOfAvailableSeasons ?? 0;
                    $entity->last_updated = $competition->lastUpdated ?? null;
                });
            }
            catch(Exception $e)
            {
                var_dump($e->getMessage());
                var_dump($competition);die();
            }
        

        }

        $this->out('Datele competițiilor au fost inserate cu succes.');
    }
}