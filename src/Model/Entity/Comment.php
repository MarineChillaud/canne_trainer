<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Comment Entity
 *
 * @property int $id
 * @property int $assessment_id
 * @property \Cake\I18n\FrozenTime $date
 * @property string $comment
 * @property \Cake\I18n\Time $timestamp
 *
 * @property \App\Model\Entity\Assessment $assessment
 */
class Comment extends Entity
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
        'date' => true,
        'comment' => true,
        'timestamp' => true,
        'assessment' => true,
    ];
}
