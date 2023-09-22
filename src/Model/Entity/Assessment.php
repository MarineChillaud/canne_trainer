<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Assessment Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $video_id
 * @property \Cake\I18n\FrozenTime $date
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Video[] $videos
 * @property \App\Model\Entity\Comment[] $comments
 * @property \App\Model\Entity\Point[] $points
 */
class Assessment extends Entity
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
        'user_id' => true,
        'video_id' => true,
        'date' => true,
        'user' => true,
        'videos' => true,
        'comments' => true,
        'points' => true,
    ];
}
