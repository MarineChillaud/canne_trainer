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

    /**
     * retourn la somme des points bleus et rouges pour 1 vidéo et 1 assessment donnés
     */
    public function findByVideoAndAssessment($videoId, $assessementId)
    {
        $query = $this->find('all')
            ->where([
                'video_id' => $videoId,
                'assessment_id' => $assessementId,
            ]);
        $result = ['red' => 0, 'blue' => 0];
        foreach ($query as $point) {
            if ($point->color_point == "red")
                $result['red']++;
            if ($point->color_point == "blue")
                $result['blue']++;
        }
        return $result;
    }
}
