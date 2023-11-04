<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Entity\Assessment;
use App\Model\Table\AssessmentsTable;
use Cake\TestSuite\TestCase;
use SebastianBergmann\Type\VoidType;

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

    public function testCreateAndSaveAssessmentSuccess(): void
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

    public function testCreateAndSaveAssessmentFail(): void
    {
    $data = [
        'user_id' => 10, 
        'video_id' => 10, 
        'date' => '23-10-02 12:23', 
    ];

    $assessment = $this->Assessments->newEmptyEntity();
    $assessment = $this->Assessments->patchEntity($assessment, $data);

    $result = $this->Assessments->save($assessment);

    $this->assertFalse($result); 
    }

    public function testAssociations(): void
    {
        $userId = 1;
        $videoId = 1;
        
        $user = $this->Assessments->Users->get($userId);
        $this->assertInstanceOf('App\Model\Entity\User', $user);

        $video = $this->Assessments->Videos->get($videoId);
        $this->assertInstanceOf('App\Model\Entity\Video', $video);
    }
    
    public function testGetScores(): void
    {
        $assessmentId = 1;

        $scores = $this->Assessments->getScores($assessmentId);

        $this->assertIsArray($scores);
        $this->assertArrayHasKey('red', $scores);
        $this->assertArrayHasKey('blue', $scores);
        $this->assertIsInt($scores['red']);
        $this->assertIsInt($scores['blue']);
    }
    

    public function testGetAllPointsWithTiming(): void
    {
        $assessmentId = 1;

        $pointsWithTiming = $this->Assessments->getAllPointsWithTiming($assessmentId);

        $this->assertIsArray($pointsWithTiming);
        $this->assertNotEmpty($pointsWithTiming);
    }

    public function testGetAssessmentsData(): void
    {
        $videoId = 1;

        $video = new \App\Model\Entity\Video([
            'id' => $videoId,
            'title' => 'Video Title',
            'event' => new \App\Model\Entity\Event([
                'title' => 'Event Title',
                'date' => new \Cake\I18n\FrozenTime('2023-11-03 12:00:00') // Remplacez par la date appropriée
            ])
        ]);
    
        $assessmentsData = $this->Assessments->getAssessmentsData($video);

        $this->assertIsArray($assessmentsData);
    }

    public function testGetAssessmentsCount(): void
    {
        $userId = 1;
        $videoId = 1;

       $result = $this->Assessments->getAssessmentsCount($videoId, $userId);

       $expected = [
        'userAssessments' => 2,
        'allAssessments' => 2,
       ];

        $this->assertEquals($expected, $result);
    }
}