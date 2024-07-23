<?php

namespace App\Shell;

use App\Model\Table\ApiTable;
use App\Model\Table\CompetitionsTable;
use Cake\Console\Shell;
use Cake\ORM\TableRegistry;
use Exception;

class GetMatchShell extends Shell
{

    public function index()
    {
        $this->out('Start get matches');
        $years = [
            // 2010,
            // 2011,
            // 2012,
            // 2013,
            // 2014,
            // 2015,
            // 2016,
            // 2017,
            // 2018,
            // 2019,
            // 2020,
            // 2021,
            // 2022,
            //2023,
            2024
        ];
        $competions = CompetitionsTable::getAll();
        $index = 0;
        $total = count($competions);
        $indexRequest = 1;
        foreach($competions as $comp)
        {
            $index++;
            foreach($years as $year)
            {
                echo $index."/".$total." get matches for: ".$comp['code']." - year: ".$year."\n";
                self::getMatch($comp['code'],$year);
                $indexRequest++;
                if($indexRequest === 9)
                {
                    $indexRequest = 1;
                    for($i = 1; $i <=6 ; $i++)
                    {
                        sleep(10);
                        echo ($i*10)."secund - ";
                    }
                    echo "\n";
                }
            }
            
        }
        $this->out('End get matches');
    }

    public function getMatch($competition,$year)
    {
        $apiKey = ApiTable::getApi();
        $uri = 'http://api.football-data.org/v4/competitions/'.$competition.'/matches?season='.$year;
        $reqPrefs['http']['method'] = 'GET';
        $reqPrefs['http']['header'] = 'X-Auth-Token: '.$apiKey; // Înlocuiți cu cheia API reală

        $stream_context = stream_context_create($reqPrefs);
        $response = file_get_contents($uri, false, $stream_context);
        $matchesData = json_decode($response)->matches;

        $matchesTable = TableRegistry::getTableLocator()->get('Matches');
        $scoresTable = TableRegistry::getTableLocator()->get('Scores');
        if(empty($matchesData)){
            return;
        }
        foreach ($matchesData as $data) {
            try{
                $entity = $matchesTable->findOrCreate([
                    'id' => $data->id
                ], function ($entity) use ($data) {
                    $entity->utcDate = date('Y-m-d H:i:s', strtotime($data->utcDate));
                    $entity->status = $data->status;
                    $entity->matchday = $data->matchday;
                    $entity->stage = $data->stage ?? null;
                    $entity->lastUpdated = date('Y-m-d H:i:s', strtotime($data->lastUpdated));
                    $entity->homeTeamId = $data->homeTeam->id;
                    $entity->awayTeamId = $data->awayTeam->id;
                    $entity->areaId = $data->area->id;
                    $entity->competitionId = $data->competition->id;
                    $entity->seasonId = $data->season->id;
                    $entity->homeName = $data->homeTeam->name;
                    $entity->awayName = $data->awayTeam->name;
                    $entity->homeLogo = $data->homeTeam->crest;
                    $entity->awayLogo = $data->awayTeam->crest;
                    // Alte câmpuri pe care le dorești să le salvezi
                });
                $entity->utcDate = date('Y-m-d H:i:s', strtotime($data->utcDate));
                $entity->status = $data->status;
                $entity->matchday = $data->matchday;
                $entity->stage = $data->stage ?? null;
                $entity->lastUpdated = date('Y-m-d H:i:s', strtotime($data->lastUpdated));
                $entity->homeTeamId = $data->homeTeam->id;
                $entity->awayTeamId = $data->awayTeam->id;
                $entity->areaId = $data->area->id;
                $entity->competitionId = $data->competition->id;
                $entity->seasonId = $data->season->id;
                $entity->homeName = $data->homeTeam->name;
                $entity->awayName = $data->awayTeam->name;
                $entity->homeLogo = $data->homeTeam->crest;
                $entity->awayLogo = $data->awayTeam->crest;
                $matchesTable->save($entity);
    
                if (!empty($data->id)) {    
                    //TODO sa fac update daca exista
                    // Salvare scor
                    $score = $scoresTable->findOrCreate(
                        ['match_id' => $data->id],
                        function ($entity) use ($data) {
                            // Daca inregistrarea exista, se va face update
                            $entity->winner = $data->score->winner ?? null;
                            $entity->duration = $data->score->duration ?? null;
                            $entity->full_time_home = $data->score->fullTime->home ?? null;
                            $entity->full_time_away = $data->score->fullTime->away ?? null;
                            $entity->half_time_home = $data->score->halfTime->home ?? null;
                            $entity->half_time_away = $data->score->halfTime->away ?? null;
                        }
                    );

                    // Setează câmpurile pentru update sau create
                    $score->winner = $data->score->winner ?? null;
                    $score->duration = $data->score->duration ?? null;
                    $score->full_time_home = $data->score->fullTime->home ?? null;
                    $score->full_time_away = $data->score->fullTime->away ?? null;
                    $score->half_time_home = $data->score->halfTime->home ?? null;
                    $score->half_time_away = $data->score->halfTime->away ?? null;

                    // Salvează entitatea
                    $scoresTable->save($score);
                } else {
                    $this->err('Nu s-a putut salva meciul ' . $data->id);
                }
            }catch(Exception $e)
            {
                var_dump($e->getMessage());die();
            }
           
            
        }

        $this->out('Datele meciurilor au fost inserate cu succes.');
    }
}
