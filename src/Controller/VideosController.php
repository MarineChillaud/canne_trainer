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
        // interroger le model
        // Récupérer la vidéo correspondant à l'id fourni
        $video = $this->Videos->get($id);
        $points = $PointsTable->findByVideoAndAssessment($id, 1);
        $this->set(compact('video', 'points'));
    }
}
