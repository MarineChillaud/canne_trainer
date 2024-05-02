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

    public function index($eventId)
    {
        $this->Videos->updateFromApi($eventId);

        $videos = $this->Videos->find('all', ['contain' => 'Events'])
        ->where(['Videos.event_id' => $eventId])
        ->all();

        $assessmentsTable = $this->fetchTable('Assessments');

        if ( ! $this->Authentication->getIdentity()) {
            // si pas d'utilisateur connecté on passe en mode anonyme
            $newUser = $this->fetchTable('Users')->addAnonymous();
            $this->Flash->success('Mode Anonnyme');
            // ... et on le connecte
            $this->Authentication->setIdentity($newUser);
        }
        $userId = $this->Authentication->getIdentity()->id;

        foreach ($videos as $video) {
            $assessmentsCount = $this->Videos->Assessments->getAssessmentsCount($video->id, $userId);
            $video->userAssessments = $assessmentsCount['userAssessments'];
            $video->allAssessments = $assessmentsCount['allAssessments'];
        }

        $event = $this->Videos->Events->get($eventId);

        $this->set(compact('videos', 'event'));
    }

    /**
     * @param int id  l'id de la vidéo à afficher
     */

    public function view($id, $assessmentId = 0)
    {
        $user = $this->Authentication->getIdentity();

        $userId =  $user->id ;

        if ($assessmentId === 0) {
            $newAssessment = $this->fetchTable('Assessments')->add($userId, $id);
            $this->Flash->success('Nouvelle évaluation');

            return $this->redirect([
                'controller' => 'Videos',
                'action' => 'view',
                $id,
                $newAssessment->id,
            ]);
        }

        //@todo: sécurité : il faudra vérifier les droits du user sur l'assessemnt

        if ($this->request->is('post')) {
            $this->fetchTable('Points')->addColorPoint(
                $this->request->getData('video_id'),
                $assessmentId,
                $this->request->getData('color_point'),
                $this->request->getData('current_time')
            );
        }

        // Query the model
        $video = $this->Videos->get($id);
        $points = $this->Videos->Assessments->getScores($assessmentId);
        $flagPoints = $this->Videos->Assessments->getAllPointsWithTiming($assessmentId);

        $this->set(compact('video', 'points', 'flagPoints', 'assessmentId'));
        // repose sur le header 'accept' 
        if ($this->request->is('json')) {
            $this->set(['_serialize' => ['video', 'points', 'flagPoints']]);
            // voir doc pour comprendre exactement 
            $this->viewBuilder()->setLayout('ajax');
        }
    }
}
