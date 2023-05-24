<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Video extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
