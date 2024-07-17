<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ScoresFixture
 */
class ScoresFixture extends TestFixture
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
                'match_id' => 1,
                'winner' => 'Lorem ipsum dolor sit amet',
                'duration' => 'Lorem ipsum dolor sit amet',
                'full_time_home' => 1,
                'full_time_away' => 1,
                'half_time_home' => 1,
                'half_time_away' => 1,
            ],
        ];
        parent::init();
    }
}
