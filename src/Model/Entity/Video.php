<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Video Entity
 *
 * @property int $id
 * @property int $event_id
 * @property string $title
 * @property string|null $url
 * @property int|null $offset
 * @property \Cake\I18n\FrozenTime $date
 *
 * @property \App\Model\Entity\Event $event
 * @property \App\Model\Entity\Assessment[] $assessments
 */
class Video extends Entity
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
        'event_id' => true,
        'title' => true,
        'url' => true,
        'offset' => true,
        'date' => true,
        'event' => true,
        'assessments' => true,
    ];
}
