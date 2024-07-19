<?php

namespace App\Shell;

use App\Model\Table\MatchesTable;
use App\Model\Table\PredictionsTable;
use Cake\Console\Shell;
use Cake\ORM\TableRegistry;

class GeneratePredictionShell extends Shell
{

    public function main()
    {
        $year = 2024;
        $months = [
            1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12
        ];
        $predictionsTable = TableRegistry::getTableLocator()->get('Predictions');
        foreach ($months as $key => $month) {
            echo ++$key."/".count($months)."\n";
            $daysInMonth = (new \DateTime("{$year}-{$month}-01"))->format('t');
            for ($day = 1; $day <= $daysInMonth; $day++) {
                $date = date("Y-m-d",strtotime("$year-$month-$day"));
                $matchs = MatchesTable::getByDate($date);
                foreach ($matchs as $match) {
                    if($match['id'] == 428778)
                    {
                        var_dump($match);die();
                    }
                    $last5Match = MatchesTable::getLast5Match($match['matches']['homeTeamId'], $match['matches']['awayTeamId']);
                    if (count($last5Match) > 3) {
                        $procentOver0 = PredictionsTable::getOver0($last5Match);
                        $procentOver1 = PredictionsTable::getOver1($last5Match);
                        $procentOver2 = PredictionsTable::getOver2($last5Match);
                        $procentOver0FirstHalf = PredictionsTable::getOver0FirstHalf($last5Match);

                        $entity = $predictionsTable->findOrCreate([
                            'matchId ' => $match['matches']['id']
                        ], function ($entity) use ($procentOver0,$procentOver1,$procentOver2,$procentOver0FirstHalf, $match) {
                            $entity['matchId'] = $match['matches']['id'];
                            $entity['over0'] = $procentOver0;
                            $entity['over1'] = $procentOver1;
                            $entity['over2'] = $procentOver2;
                            $entity['over0FirstHalf'] = $procentOver0FirstHalf;
                            // Alte câmpuri pe care le dorești să le salvezi
                        });
                        $entity['matchId'] = $match['matches']['id'];
                        $entity['over0'] = $procentOver0;
                        $entity['over1'] = $procentOver1;
                        $entity['over2'] = $procentOver2;
                        $entity['over0FirstHalf'] = $procentOver0FirstHalf;
                        $predictionsTable->save($entity);
                    }
                }
            }
        }
    }
}
