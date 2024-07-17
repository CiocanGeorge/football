<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CompetitionsFixture
 */
class CompetitionsFixture extends TestFixture
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
                'area_id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'code' => 'L',
                'type' => 'Lorem ipsum dolor sit amet',
                'emblem' => 'Lorem ipsum dolor sit amet',
                'plan' => 'Lorem ipsum dolor sit amet',
                'current_season_id' => 1,
                'number_of_available_seasons' => 1,
                'last_updated' => '2024-07-05 20:48:52',
            ],
        ];
        parent::init();
    }
}
