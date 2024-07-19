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
         var_dump($match['id']);die();
            $matches[$key]['Prediction'] = PredictionsTable::getByMatchId($match['matches']['id']);
        }


        $this->set('data', $date);
        $this->set(compact('matches'));
        $this->viewBuilder()->setOption('serialize', ['matches']);
    }
}
