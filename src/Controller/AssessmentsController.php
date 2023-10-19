<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\Assessment;

/**
 * Assessments Controller
 *
 * @property \App\Model\Table\AssessmentsTable $Assessments
 * @method \App\Model\Entity\Assessment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AssessmentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $videos = $this->Assessments->Videos->find('all', ['contain' => 'Events']);

        $user = $this->Authentication->getIdentity();
        $session = $this->request->getSession();        //@todo: utiliser displayFilter pour filtrer les vidéos.


        $userId = $user ? $user->id : $session->read('User.id');

        foreach ($videos as $video) {
            $assessmentsCount = $this->Assessments->getAssessmentsCount($video->id, $userId);
            $video->userAssessments = $assessmentsCount['userAssessments'];
            $video->allAssessments = $assessmentsCount['allAssessments'];

            $dataVideo = $this->Assessments->getAssessmentsData($video);
            $video->eventTitle = $dataVideo['eventTitle'];
            $video->eventDate = $dataVideo['eventDate'];
            $video->videoTitle = $dataVideo['videoTitle'];
        }

        $this->set(compact('videos'));
    }

    /**
     * View method
     *
     * @param string|null $id Assessment id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id)
    {
        $assessment = $this->Assessments->get($id);
        $scores = $this->Assessments->getScores($id);
        $this->set(compact('assessment', 'scores'));
    }

    public function review($videoId, $displayFilter)
    {
        $assessments = $this->Assessments->findByVideoId($videoId);
        if ($displayFilter === 'own') {
            $userId = $session = $this->request->getSession()->read('User.id');
            $assessments = $this->Assessments->findByVideoIdAndUserId($videoId, $userId);
        }
        $this->set(compact('assessments'));
    }
}
