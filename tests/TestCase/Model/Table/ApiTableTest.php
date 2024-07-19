<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ApiTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ApiTable Test Case
 */
class ApiTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ApiTable
     */
    protected $Api;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Api',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Api') ? [] : ['className' => ApiTable::class];
        $this->Api = $this->getTableLocator()->get('Api', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Api);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ApiTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
