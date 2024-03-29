<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EventsFixture
 */
class EventsFixture extends TestFixture
{
    public $import = ['table' => 'events'];

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
                'title' => 'Lorem ipsum dolor sit amet',
                'date' => '2023-10-02 12:23:41',
            ],
            [
                'id' => 2,
                'title' => 'Lorem ipsum dolor sit amet',
                'date' => '2023-10-05 12:35:46',
            ],
        ];
        parent::init();
    }
}
