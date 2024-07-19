<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ApiFixture
 */
class ApiFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'api';
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
                'apiKey' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
