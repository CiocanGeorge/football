<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PredictionsFixture
 */
class PredictionsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'matchId' => 1,
                'over2' => 'Lorem ipsum dolor sit amet',
                'under2' => 'Lorem ipsum dolor sit amet',
                'over0' => 'Lorem ipsum dolor sit amet',
                'under0' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
