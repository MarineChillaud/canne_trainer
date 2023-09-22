<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PointsFixture
 */
class PointsFixture extends TestFixture
{
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
                'created' => '2023-09-22 10:55:47',
                'color_point' => 'Lorem ipsum dolor sit amet',
                'timing' => 1,
            ],
        ];
        parent::init();
    }
}
