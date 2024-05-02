<?php

declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * VideosFixture
 */
class VideosFixture extends TestFixture
{
    public $import = ['table' => 'videos'];

    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'event_id' => 1,
                'title' => 'Title test',
                'url' => 'urlVideoTest',
                'date' => '2023-10-02 12:24:00',
            ], [
                'event_id' => 1,
                'title' => 'Title test',
                'url' => 'urlVideoTest',
                'date' => '2023-10-02 12:24:00',
            ],
        ];
        parent::init();
    }
}
