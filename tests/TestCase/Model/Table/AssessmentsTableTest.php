<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AssessmentsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AssessmentsTable Test Case
 */
class AssessmentsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AssessmentsTable
     */
    protected $Assessments;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    public $fixtures = [
        'app.Assessments',
        'app.Users',
        'app.Videos',
        'app.Comments',
        'app.Points',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Assessments') ? [] : ['className' => AssessmentsTable::class];
        $this->Assessments = $this->getTableLocator()->get('Assessments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Assessments);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AssessmentsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\AssessmentsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    public function testCreateAssessment(): void
    {
        $data = [
            'user_id' => 1, 
            'video_id' => 1, 
            'date' => '2023-10-02 12:23:23',
        ];

       $assessment = $this->Assessments->newEmptyEntity();
       $assessment = $this->Assessments->patchEntity($assessment, $data);

       $result = $this->Assessments->save($assessment);

       $this->assertInstanceOf('App\Model\Entity\Assessment', $result);
       $this->assertEquals(1, $result->user_id);
       $this->assertEquals($data['video_id'], $result->video_id);
    }
}
