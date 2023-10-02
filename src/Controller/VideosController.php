<?php

namespace App\Controller;

use Cake\Event\EventInterface;
use App\Controller\Component\CsrfProtectionComponent;
use Cake\I18n\FrozenTime;
use Cake\Utility\Text;

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
    }

    public function index()
    {
        $videos = $this->Videos->find('all', ['contain' => 'Events']);
        $this->set(compact('videos'));
    }

    /**
     * @param int id  l'id de la vidéo à afficher
     */

    private function fakeDevUser($videoId)
    {
        $session = $this->request->getSession();
        // Vérifier si la session est démarrée, si non la démarrer
        if (!$session->started()) {
            $session->start();

            if (!$session->check('User.id')) {
                //Vérifier si le User.id existe dans la session, si non le créer et un assessement
                $newUser = $this->fetchTable('Users')->addAnonymous();
                $newAssessment = $this->fetchTable('Assessments')->add($newUser->id, $videoId);
                // sauvegarder l'Id dans la session 
                $session->write('User.id', $newUser->id);
                $session->write('Assessment.id', $newAssessment->id);

                $this->Flash->success('Bienvenue, un User_id' . $newUser->id . 'a été généré pour vous');
            }
        } else {
            $this->Flash->error('la session est deja active');
        }
        return $session;
    }

    public function view($id)
    {
        // pour pas avoir à s'inscrire/se connecter.
        $session = $this->fakeDevUser($id);

        // Récupérer la valeur de User.id depuis la session
        $userId = $session->read('User.id');
        $assessmentId = $session->read('Assessment.id');
        // il faudrait vérifier les droits du user sur l'assessemnt

        if ($this->request->is('post')) {
            // cas de traitement de formulaire
            // ne s'active que s'il recoit des informations d'un formulaire en method POST
            $this->fetchTable('Points')->addColorPoint(
                $this->request->getData('video_id'),
                $this->request->getData('assessment_id'),
                $this->request->getData('color_point'),
                $this->request->getData('current_time')
            );
        }

        // interroger le model 
        $video = $this->Videos->get($id);
        $points = $this->Videos->Assessments->getScores($assessmentId);

        $this->set(compact('userId', 'assessmentId', 'video', 'points'));
        // repose sur le header 'accept' 
        if ($this->request->is('json')) {
            $this->set(['_serialize' => ['video', 'points', 'assessmentId']]);
            // voir doc pour comprendre exactement 
            $this->viewBuilder()->setLayout('ajax');
        }
    }

    public function login()
    {

        $this->render('login');
    }
}
