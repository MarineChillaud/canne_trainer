<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\VideosController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\VideosController Test Case
 *
 * @uses \App\Controller\VideosController
 */
class VideosControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    public $fixtures = [
        'app.Videos',
        'app.Events',
        'app.Assessments',
    ];

    /**
     * Test beforeFilter method
     *
     * @return void
     * @uses \App\Controller\VideosController::beforeFilter()
     */
    public function testBeforeFilter(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\VideosController::index()
     */
    public function testIndex(): void
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
        $this->get('/videos');

        $this->assertResponseOk();
        // $this->assertResponseContains('Liste des vidéos'); 
        $this->assertResponseContains('Title test'); 
        $this->assertResponseContains('urlVideoTest'); 
        $this->assertResponseContains('2023-10-02 12:24:00'); 

    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\VideosController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
