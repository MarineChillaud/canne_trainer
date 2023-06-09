<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class PointsTable extends Table
{
    public function initialize(array $config): void
    {
    }

    public $belongsTo = [
        'Assessment' => 'Assessement',
        'foreignKey' => 'assessment_id',
    ];
}
