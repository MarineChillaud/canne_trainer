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
        $assessmentsTable = $this->fetchTable('Assessments');

        $videos = $this->Videos->find('all', ['contain' => 'Events']);

        foreach ($videos as $video) {
            //récupère le nombre d'assessement pour 1 vidéo et 1 user
            $userAssessments = $assessmentsTable->find()
                ->select(['user_id'])
                ->where(['video_id' => $video->id])
                ->group(['user_id'])
                ->count();

            // récupère tous les assessments pour 1 vidéo
            $allAssessments = $assessmentsTable->find()
                ->where(['video_id' => $video->id])
                ->count();

            $video->userAssessments = $userAssessments;
            $video->allAssessments = $allAssessments;
        }

        $this->set(compact('videos'));
    }

    /**
     * @param int id  l'id de la vidéo à afficher
     */

    public function view($id)
    {
        $user = $this->Authentication->getIdentity();
        $session = $this->request->getSession();
        $session->start();
        $newAssessmentParam = $this->request->getQuery('newAssessment');
        $assessmentId = $this->request->getQuery('assessmentId');

        if ($user) {
            $userId = $user->id;
        } else {
            $userId = $session->read('User.id');
        }

        // si pas d'utilisateur connecté on passe en mode anonyme
        if (!$userId) {
            $newUser = $this->fetchTable('Users')->addAnonymous();
            $this->Flash->success('Mode Anonnyme (' . $newUser->id  . ')');
            // ... et on écrit dans la session pour faire comme si il s'était connecté.
            $session->write('User.id', $newUser->id);
            $userId = $newUser->id;
        }

        if ($newAssessmentParam) {
            $newAssessment = $this->fetchTable('Assessments')->add($userId, $id);
            $this->Flash->success('Nouvelle évaluation (' . $newAssessment->id . ')');

            return $this->redirect([
                'controller' => 'Videos',
                'action' => 'view',
                $id,
                '?' => ['assessmentId' => $newAssessment->id]
            ]);
        }

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
