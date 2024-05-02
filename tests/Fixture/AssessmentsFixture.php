<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AssessmentsFixture
 */
class AssessmentsFixture extends TestFixture
{
    public $import = ['table' => 'assessments'];
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
                'user_id' => 1,
                'video_id' => 1,
                'date' => '2023-10-02 12:23:23',
            ],
            [
                'id' => 2,
                'user_id' => 1,
                'video_id' => 1,
                'date' => '2023-10-02 13:45:00',
            ],
        ];

        parent::init();
    }
}
