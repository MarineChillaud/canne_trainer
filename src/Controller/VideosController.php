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
        // Questions de droit
        if ( ! $this->Authentication->getIdentity()) {
            // si pas d'utilisateur connecté on passe en mode anonyme
            $newUser = $this->fetchTable('Users')->addAnonymous();
            $this->Flash->success('Mode Anonyme');
            // ... et on le connecte
            $this->Authentication->setIdentity($newUser);
        }
        $userId = $this->Authentication->getIdentity()->id;

        // Update
        if(random_int(1,100)===1)
        {
            $this->Flash->info('Base mise à jour');
            $this->Videos->updateFromApi($eventId);
        }

        // Récupération d'information pour l'affichage
        $event = $this->Videos->Events->get($eventId, ['contain'=>'Videos']);
        $assessmentCounts=[];
        foreach ($event->videos as $video) {
            $assessmentCounts[$video->id] = $this->Videos->Assessments->getAssessmentsCount($video->id, $userId);
        }

        $this->set(compact('event','assessmentCounts'));
    }

    /**
     * @param int id  l'id de la vidéo à afficher
     */

    public function view($id, $assessmentId = 0)
    {
        $user = $this->Authentication->getIdentity();

        $userId = $user->id ;

        if ($assessmentId === 0) {
            $newAssessment = $this->Videos->Assessments->add($userId, $id);
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
            $this->Videos->Assessments->Points->addColorPoint(
                $this->request->getData('video_id'),
                $assessmentId,
                $this->request->getData('color_point'),
                $this->request->getData('current_time')
            );
        }

        // Query the model
        $video = $this->Videos->get($id);
        $scores = $this->Videos->Assessments->getScores($assessmentId);
        $flagPoints = $this->Videos->Assessments->getAllPointsWithTiming($assessmentId);

        $this->set(compact('video', 'assessmentId', 'scores', 'flagPoints'));
        // repose sur le header 'accept' 
        if ($this->request->is('json')) {
            $this->viewBuilder()->setOption('serialize', ['video', 'scores', 'flagPoints']);
            // $this->set(['_serialize' => ['video', 'scores', 'flagPoints']]);
            // voir doc pour comprendre exactement 
            $this->viewBuilder()->setLayout('ajax');
        }
    }
}
