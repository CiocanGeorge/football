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
            echo ++$key . "/" . count($months) . "\n";
            $daysInMonth = date('t', strtotime("$year-$month-01"));
            for ($day = 1; $day <= $daysInMonth; $day++) {
                $date = date("Y-m-d", strtotime("$year-$month-$day"));
                echo "\tday: " . $day . "\n";
                $matchs = MatchesTable::getByDate($date);
                foreach ($matchs as $match) {
                    $last5Match = MatchesTable::getLast5Match($match['homeTeamId'], $match['awayTeamId'], $match['id']);
                    $last5MatchHomeTeam = MatchesTable::getLast5MatchCurrent($match['homeTeamId'], $match['id']);
                    $last5MatchAwayTeam = MatchesTable::getLast5MatchCurrent($match['homeTeamId'], $match['id']);
                    if (count($last5Match) >= 4) {
                        $procentOver0 = PredictionsTable::getOver0($last5Match, $last5MatchHomeTeam, $last5MatchAwayTeam);
                        $procentOver1 = PredictionsTable::getOver1($last5Match, $last5MatchHomeTeam, $last5MatchAwayTeam);
                        $procentOver2 = PredictionsTable::getOver2($last5Match, $last5MatchHomeTeam, $last5MatchAwayTeam);
                        $procentOver0FirstHalf = PredictionsTable::getOver0FirstHalf($last5Match, $last5MatchHomeTeam, $last5MatchAwayTeam);
                        $procentGG = PredictionsTable::getGG($last5Match, $last5MatchHomeTeam, $last5MatchAwayTeam);

                        $entity = $predictionsTable->findOrCreate([
                            'matchId ' => $match['id']
                        ], function ($entity) use ($procentOver0, $procentOver1, $procentOver2, $procentOver0FirstHalf, $procentGG, $match) {
                            $entity['matchId'] = $match['id'];
                            $entity['over0'] = $procentOver0;
                            $entity['over1'] = $procentOver1;
                            $entity['over2'] = $procentOver2;
                            $entity['over0FirstHalf'] = $procentOver0FirstHalf;
                            $entity['gg'] = $procentGG;
                            // Alte câmpuri pe care le dorești să le salvezi
                        });
                        $entity['matchId'] = $match['id'];
                        $entity['over0'] = $procentOver0;
                        $entity['over1'] = $procentOver1;
                        $entity['over2'] = $procentOver2;
                        $entity['over0FirstHalf'] = $procentOver0FirstHalf;
                        $entity['gg'] = $procentGG;
                        $predictionsTable->save($entity);
                    }
                }
            }
        }
    }
}
