<?php

declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use App\Model\Entity\Prediction;
use App\Model\Table\CompetitionsTable;
use App\Model\Table\MatchesTable;
use App\Model\Table\PredictionsTable;
use Cake\Controller\Controller;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class HomeController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
    }

    public function index()
    {
        $predictionsTable = PredictionsTable::getObject();
        $date = date('Y-m-d');
        if ($this->request->is('post')) { // Verifică dacă este cerere POST
            $postData = $this->request->getData(); // Accesează datele POST
            $date = date('Y-m-d', strtotime($postData['data']));
            // Procesează datele cum dorești
            // De exemplu, salvare în baza de date, validare, etc.
        }
        // Dacă cererea este Ajax, returnează doar datele în format JSON
        $matches = MatchesTable::getByDate($date);
        foreach ($matches as $key => $match) {
            $matches[$key]['Prediction'] = PredictionsTable::getByMatchId($match['id']);
        }


        $this->set('data', $date);
        $this->set(compact('matches'));
    }

    public function statistics()
    {
        $year = date("Y");
        $months = [
            "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"
        ];
        foreach ($months as $key => $month) {

            $data[$month]["Prima repriza peste 0.5"] = PredictionsTable::getStats("over0FirstHalf", $year . "-" . $month);
            $data[$month]["Peste 0.5"] = PredictionsTable::getStats("over0", $year . "-" . $month);
            $data[$month]["Peste 1.5"] = PredictionsTable::getStats("over1", $year . "-" . $month);
            $data[$month]["Peste 2.5"] = PredictionsTable::getStats("over2", $year . "-" . $month);
            $data[$month]["Ambele echipe marcheaza"] = PredictionsTable::getStats("gg", $year . "-" . $month);
        }
        $this->set('data', $data);
    }
}
