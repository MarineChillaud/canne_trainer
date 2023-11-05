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
                'assessment_id' => 1,
                'color' => 'red',
                'timing' => 159.256,
            ],
            [
                'assessment_id' => 1,
                'color' => 'blue',
                'timing' => 205.235,
            ],
        ];
        parent::init();
    }
}
