<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Point Entity
 *
 * @property int $id
 * @property int $assessment_id
 * @property string $color
 * @property float|null $timing
 *
 * @property \App\Model\Entity\Assessment $assessment
 */
class Point extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'assessment_id' => true,
        'color' => true,
        'timing' => true,
        'assessment' => true,
    ];
}
