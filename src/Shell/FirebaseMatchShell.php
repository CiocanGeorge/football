<?php

namespace App\Shell;

use App\Model\Table\PredictionsTable;
use Kreait\Firebase\Factory;
use Cake\Console\Shell;
use Exception;

class FirebaseMatchShell extends Shell
{

    public function main()
    {
        try {
            $firebase = (new Factory)
                ->withServiceAccount(realpath(__DIR__ . '/../../serviceAccountKey.json')) // Specifică calea către fișierul serviceAccountKey.json
                ->withDatabaseUri('https://statistics-e6ffc-default-rtdb.europe-west1.firebasedatabase.app/');
        } catch (Exception $e) {
            var_dump($e->getMessage());
            die();
        }


        $this->database = $firebase->createDatabase();
        $date = date("Y-m-d");
        for ($i = 0; $i < 3; $i++) {
            if ($i > 0) {
                $date = date("Y-m-d", strtotime(" +" . $i . +" days"));
            }
            $matches = PredictionsTable::getAllStatsOver50($date);
            foreach ($matches as $match) {
                $this->adaugaMeci(
                    date("Y-m-d", strtotime($match['matches']["utcDate"])),
                    "fotbal",
                    $match['matches']["id"],
                    [
                        'nume' => $match['matches']["homeName"],
                        'poza' => $match['matches']["homeLogo"],
                    ],
                    [
                        'nume' => $match['matches']["awayName"],
                        'poza' => $match['matches']["awayLogo"],
                    ],
                    [
                        'G-2-5' => (int)$match['over2'],
                        'G-1-5' => (int)$match['over1'],
                        'G-1H0-5' => (int)$match['over0FirstHalf'],
                        'gg' => (int)$match['over1'],
                    ]
                );
                echo "Datele meciului a fost adăugate!\n";
            }
        }
    }
    private function adaugaMeci($ziua, $sport, $idMeci, $gazda, $oaspete, $predictii)
    {
        // Structura pentru datele meciului
        $data = [
            'echipaGazda' => $gazda,
            'echipaOaspete' => $oaspete,
            'predictii' => $predictii
        ];

        // Referință către locația specificată în Firebase Realtime Database
        $meciRef = "meciuri/$ziua/$sport/$idMeci";
        $this->database->getReference($meciRef)->set($data);
    }
}
