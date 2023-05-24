<?php

namespace App\Controller;

class PointsController extends AppController
{
    public function edit($id)
    {
        $point = $this->Points->get($id);
        $point = $this->Points->patchEntity($point, $this->request->getData());
        if ($this->Points->save($point)) {
            $this->Flash->success(__('Le point a été enregistré.'));
        } else {
            $this->Flash->error(__('Le point n\'a pas pu être enregistré. Veuillez réessayer.'));
        }
        return $this->redirect($this->referer());
    }

    public function add()
{
    $point = $this->Points->newEmptyEntity();
    if ($this->request->is('post')) {
        $point = $this->Points->patchEntity($point, $this->request->getData());
        if ($this->Points->save($point)) {
            $this->Flash->success(__('Le point a été sauvegardé.'));

            return $this->redirect(['controller' => 'Videos', 'action' => 'view', $point->video_id]);
        }
        $this->Flash->error(__('Le point n\'a pas été sauvegardé. Veuillez réessayer.'));
    }
}
    
}