<?php

namespace App\Controller;

use Cake\Event\EventInterface;
use App\Controller\Component\CsrfProtectionComponent;

class VideosController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent(CsrfProtectionComponent::class);
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->getRequest()->getAttribute('csrfToken');
        $this->Authentication->allowUnauthenticated(['view', 'index']);
    }

    public function index()
    {
        $videos = $this->Videos->find('all', ['contain' => 'Events']);
        $this->set(compact('videos'));
    }

    /**
     * @param int id  l'id de la vidéo à afficher
     */

    public function view($id)
    {
        $session = $this->request->getSession();
        $session->start();

        if (!$session->check('User.id')) {
            // si pas d'utilisateur connecté on passe en mode anonyme
            $newUser = $this->fetchTable('Users')->addAnonymous();
            $this->Flash->success('Mode Anonnyme (' . $newUser->id  . ')');
            // ... et on écrit dans la session pour faire comme si il s'était connecté.
            $session->write('User.id', $newUser->id);
        }
        $userId = $session->read('User.id');
        if (!$session->check('Assessment.id')) {
            // si pas d'évaluation en cours, on en crée une
            $newAssessment = $this->fetchTable('Assessments')->add($newUser->id, $id);
            $this->Flash->success('Nouvelle tentative ('  . $newAssessment->id . ')');
            $session->write('Assessment.id', $newAssessment->id);
        }
        $assessmentId = $session->read('Assessment.id');

        //@todo: sécurité : il faudra vérifier les droits du user sur l'assessemnt

        if ($this->request->is('post')) {
            // cas de traitement de formulaire
            // ne s'active que s'il recoit des informations d'un formulaire en method POST
            $this->fetchTable('Points')->addColorPoint(
                $this->request->getData('video_id'),
                $assessmentId,
                $this->request->getData('color_point'),
                $this->request->getData('current_time')
            );
        }

        // interroger le model 
        $video = $this->Videos->get($id);
        $points = $this->Videos->Assessments->getScores($assessmentId);

        $this->set(compact('video', 'points'));
        // repose sur le header 'accept' 
        if ($this->request->is('json')) {
            $this->set(['_serialize' => ['video', 'points']]);
            // voir doc pour comprendre exactement 
            $this->viewBuilder()->setLayout('ajax');
        }
    }
}
