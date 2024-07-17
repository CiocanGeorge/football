<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TeamsFixture
 */
class TeamsFixture extends TestFixture
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
                'name' => 'Lorem ipsum dolor sit amet',
                'shortName' => 'Lorem ipsum dolor sit amet',
                'tla' => 'L',
                'crest' => 'Lorem ipsum dolor sit amet',
                'address' => 'Lorem ipsum dolor sit amet',
                'website' => 'Lorem ipsum dolor sit amet',
                'founded' => 1,
                'clubColors' => 'Lorem ipsum dolor sit amet',
                'venue' => 'Lorem ipsum dolor sit amet',
                'lastUpdated' => 1720363016,
            ],
        ];
        parent::init();
    }
}
