<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MatchesFixture
 */
class MatchesFixture extends TestFixture
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
                'utcDate' => '2024-07-07 14:37:08',
                'status' => 'Lorem ipsum dolor sit amet',
                'matchday' => 1,
                'stage' => 'Lorem ipsum dolor sit amet',
                'last_updated' => '2024-07-07 14:37:08',
                'home_team_id' => 1,
                'away_team_id' => 1,
                'area_id' => 1,
                'competition_id' => 1,
                'season_id' => 1,
            ],
        ];
        parent::init();
    }
}
