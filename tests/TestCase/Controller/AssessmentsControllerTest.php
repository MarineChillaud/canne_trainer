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
     * @uses \App\Controller\AssessmentsController::review()
     */
    public function testReview(): void
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

        $this->get('/assessments/review/1/all');
        $this->assertResponseOk();

        $this->get('/assessments/review/1/1');
        $this->assertResponseOk();

        // $this->get('/assessments/review/1/own');
        // $this->assertResponseOk();
    }

    public function testNavigationFromPoints(): void
    {
        $this->enableCsrfToken();
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

        $this->get('/assessments/review/1/1');
        $this->assertResponseOk();

        $this->assertResponseContains('Title test');
        $this->assertResponseContains('red');
        $this->assertResponseContains('blue');

        $this->post('assessments/review/1/1', ['pointId' => 1]);

        $this->assertResponseOk();
        $this->assertResponseContains('Title test');
        // $this->assertResponseContains('<div class="point-flag red" title="1:159.256" data-time="159.256"></div>');


    }

    public function testVideoNotFound(): void
{
    $this->session([
        'Auth' => [
            'User' => [
                'id' => 1,
                'username' => 'testing',
                'password' => 'testing1234*',
                'firstName' => 'Testing',
                'lastName' => 'Testing',
                'created' => '2023-10-29 15:37:46',
            ]
        ]
    ]);

    // Utilisez un ID de vidéo qui n'existe pas (par exemple, 99999).
    $this->get('/assessments/review/99999/all');
    $this->assertResponseCode(404); // Assurez-vous que l'action renvoie une réponse 404 Not Found.
}

public function testPerformance(): void
{
   $this->session([
       'Auth' => [
           'User' => [
               'id' => 1,
               'username' => 'testing',
               'password' => 'testing1234*',
               'firstName' => 'Testing',
               'lastName' => 'Testing',
               'created' => '2023-10-29 15:37:46',
           ]
       ]
   ]);

   $start = microtime(true);
   $this->get('/assessments/review/1/all');
   $end = microtime(true);
   $time = $end - $start;

   $this->assertLessThan(0.1, $time); 
}


    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\AssessmentsController::add()
     */
    // public function testAdd(): void
    // {
    //     $this->markTestIncomplete('Not implemented yet.');
    // }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\AssessmentsController::edit()
     */
    // public function testEdit(): void
    // {
    //     $this->markTestIncomplete('Not implemented yet.');
    // }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\AssessmentsController::delete()
     */
    // public function testDelete(): void
    // {
    //     $this->markTestIncomplete('Not implemented yet.');
    // }
}
