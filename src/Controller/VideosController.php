<?php

namespace App\Controller;

class VideosController extends AppController
{
    public function index()
    {
        $videos = $this->Videos->find('all', ['contain' => 'Events']);
        $this->set(compact('videos'));
    }
    public function view($id)
    {
        // Récupérer la vidéo correspondant à l'id fourni
        $video = $this->Videos->get($id);
        $this->set(compact('video'));
        $this->set('points',[]);
    }
}
