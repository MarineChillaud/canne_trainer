<?php

namespace App\Controller;

class VideosController extends AppController
{
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
        $PointsTable = $this->fetchTable('Points');
        // cas de traitement de formulaire
        if ($this->request->is('post')) {
            // ne s'active que s'il recoit des informations d'un formulaire en method POST
            pr($this->request->getData());
        }

        // interroger le model
        // Récupérer la vidéo correspondant à l'id fourni
        $video = $this->Videos->get($id);
        $points = $PointsTable->findByVideoAndAssessment($id, 1);
        $assessmentId = 1; //@todo: un jour avoir le vrai cf session
        $this->set(compact('video', 'points', 'assessmentId'));
    }
}
