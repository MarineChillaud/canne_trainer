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
            $newPoint = $PointsTable->newEmptyEntity();
            $newPoint->video_id = $this->request->getData('video_id');
            $newPoint->assessment_id = $this->request->getData('assessment_id');
            $newPoint->color_point = $this->request->getData('color_point');
            $newPoint->timing = 0; //@todo: récupérer le vrai timing de la video. 
            $PointsTable->save($newPoint);
        }

        // interroger le model
        // Récupérer la vidéo correspondant à l'id fourni
        $video = $this->Videos->get($id);
        $points = $PointsTable->findByVideoAndAssessment($id, 1);
        $assessmentId = 1; //@todo: un jour avoir le vrai cf session
        $this->set(compact('video', 'points', 'assessmentId'));
    }
}
