<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CurrentSeasonsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CurrentSeasonsTable Test Case
 */
class CurrentSeasonsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CurrentSeasonsTable
     */
    protected $CurrentSeasons;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.CurrentSeasons',
        'app.Competitions',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('CurrentSeasons') ? [] : ['className' => CurrentSeasonsTable::class];
        $this->CurrentSeasons = $this->getTableLocator()->get('CurrentSeasons', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->CurrentSeasons);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\CurrentSeasonsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
