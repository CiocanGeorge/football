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
        $matches = PredictionsTable::getAllStatsOver50();
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
            die();
        }
        die();
        $meciuri = [
            [
                'ziua' => '2024-11-03',
                'sport' => 'fotbal',
                'idMeci' => 'meci1',
                'gazda' => ['nume' => 'Cagliari', 'poza' => 'URL_poza_Cagliari'],
                'oaspete' => ['nume' => 'Bologna', 'poza' => 'URL_poza_Bologna'],
                'predictii' => [
                    'rezultatFinal' => '1X',
                    'cornere' => '9.5+',
                    'goluri' => '2.5+',
                    'cartonase' => ['red' => '2.5+']
                ]
            ],
            [
                'ziua' => '2024-11-03',
                'sport' => 'fotbal',
                'idMeci' => 'meci2',
                'gazda' => ['nume' => 'Lecce', 'poza' => 'URL_poza_Lecce'],
                'oaspete' => ['nume' => 'Verona', 'poza' => 'URL_poza_Verona'],
                'predictii' => [
                    'rezultatFinal' => '2',
                    'cornere' => '7.5+',
                    'goluri' => '2.5+'
                ]
            ],
            [
                'ziua' => '2024-11-04',
                'sport' => 'fotbal',
                'idMeci' => 'meci3',
                'gazda' => ['nume' => 'AC Milan', 'poza' => 'URL_poza_AC_Milan'],
                'oaspete' => ['nume' => 'Napoli', 'poza' => 'URL_poza_Napoli'],
                'predictii' => [
                    'rezultatFinal' => '1',
                    'cornere' => '8.5+',
                    'goluri' => '3.5+',
                    'cartonase' => ['yellow' => '2.5+']
                ]
            ]
        ];

        foreach ($meciuri as $meci) {
            $this->adaugaMeci(
                $meci['ziua'],
                $meci['sport'],
                $meci['idMeci'],
                $meci['gazda'],
                $meci['oaspete'],
                $meci['predictii']
            );
            echo "Datele meciului {$meci['idMeci']} au fost adăugate!\n";
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
