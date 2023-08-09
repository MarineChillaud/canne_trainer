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


    public function view($id)
    {
        $session = $this->request->getSession();

        // Vérifier si la session est démarrée, si non la démarrer
        if (!$session->started()) {
            $session->start();

            //Vérifier si le User.id existe dans la session, si non le générer
            if (!$session->check('User.id')) {
                $user_id = text::uuid();
                // sauvegarder l'Id dans la session 

                $session->write('User.id', $user_id);

                $UsersTable = $this->fetchTable('Users');

                $newUser = $UsersTable->newEntity([
                    'id' => $user_id,
                    'username' => 'toto',
                    'password' => bin2hex(random_bytes(8)),
                    'firstName' => 'firsname_' . substr(md5(uniqid()), 0, 6),
                    'lastName' => 'lastname_' . substr(md5(uniqid()), 0, 6),
                    'created' => FrozenTime::now(),
                ]);
                $UsersTable->save($newUser);

                $this->Flash->success('Bienvenue, un User_id' . $user_id . 'a été généré pour vous');
            }
        } else {
            $this->Flash->error('la session est inactive');
        }

        // Récupérer la valeur de User.id depuis la session
        $userId = $session->read('User.id');
        $this->set(compact('userId'));

        $PointsTable = $this->fetchTable('Points');
        // cas de traitement de formulaire
        if ($this->request->is('post')) {
            // ne s'active que s'il recoit des informations d'un formulaire en method POST
            $newPoint = $PointsTable->newEmptyEntity();
            $newPoint->video_id = $this->request->getData('video_id');
            $newPoint->assessment_id = $this->request->getData('assessment_id');
            $newPoint->color_point = $this->request->getData('color_point');
            $newPoint->timing = $this->request->getData('current_time');
            $PointsTable->save($newPoint);
        }

        // interroger le model
        // Récupérer la vidéo correspondant à l'id fourni
        $video = $this->Videos->get($id);
        $points = $PointsTable->findByVideoAndAssessment($id, 1);

        $assessmentId = 1; //@todo: un jour avoir le vrai cf session
        $this->set(compact('video', 'points', 'assessmentId'));
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
