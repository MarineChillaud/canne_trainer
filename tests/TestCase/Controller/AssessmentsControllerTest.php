<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\AssessmentsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\AssessmentsController Test Case
 *
 * @uses \App\Controller\AssessmentsController
 */
class AssessmentsControllerTest extends TestCase
{
    use IntegrationTestTrait;

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
     * Test index method
     *
     * @return void
     * @uses \App\Controller\AssessmentsController::index()
     */
    public function testAddUnauthenticatedFailsIndex(): void
    {
        $this->get('/assessments');
        $this->assertRedirectContains('/users/login');
    }

    public function testAddUnauthenticatedIndex(): void
    {
        $this->session([
            'Auth' => [
                'User' => [
                    'id' => 1,
                    'username' => 'testing',
                    'password' => 'testing1234*',
                    "firstName" => 'Testing',
                    "lastName" => 'Testing',
                    "created" => '2023-10-29 15:37:46',
                ]
            ]
        ]);
        $this->get('assessments');

        $this->assertResponseOk();
    }

    /**
     * Test review method
     *
     * @return void
     * @uses \App\Controller\AssessmentsController::view()
     */
    // public function testReview(): void
    // {
    //     $this->get('/assessments/review/1/own');
    //     $this->assertResponseOk();
    // }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\AssessmentsController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\AssessmentsController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\AssessmentsController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
