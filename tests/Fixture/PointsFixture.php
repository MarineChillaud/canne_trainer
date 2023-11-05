<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PointsFixture
 */
class PointsFixture extends TestFixture
{
    public $import = ['table' => 'points'];

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
                'assessment_id' => 1,
                'color' => 'red',
                'timing' => 159.256,
            ],
            [
                'id' => 2,
                'assessment_id' => 1,
                'color' => 'blue',
                'timing' => 205.235,
            ],
        ];
        parent::init();
    }
}
