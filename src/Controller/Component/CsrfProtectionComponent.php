<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Event\EventInterface;

class CsrfProtectionComponent extends Component
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
    }

    public function beforeFilter(EventInterface $event)
    {
        $this->getController()->getRequest()->getAttribute('csrfToken');
    }
}
