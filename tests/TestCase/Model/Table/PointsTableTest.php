<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PointsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PointsTable Test Case
 */
class PointsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PointsTable
     */
    protected $Points;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Points',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Points') ? [] : ['className' => PointsTable::class];
        $this->Points = $this->getTableLocator()->get('Points', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Points);

        parent::tearDown();
    }

    /**
     * Test findByVideoAndAssessment method
     *
     * @return void
     * @uses \App\Model\Table\PointsTable::findByVideoAndAssessment()
     */
    public function testFindByVideoAndAssessment(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
