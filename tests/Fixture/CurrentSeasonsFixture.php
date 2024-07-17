<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CurrentSeasonsFixture
 */
class CurrentSeasonsFixture extends TestFixture
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
                'start_date' => '2024-07-05',
                'end_date' => '2024-07-05',
                'current_matchday' => 1,
                'winner' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
