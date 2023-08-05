<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class UsersTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setEntityClass('App\Model\Entity\user'); // Utilise l'entité User que nous avons créée
        $this->addBehavior('Timestamp'); // Si tu veux ajouter des timestamps created et modified
    }
}
