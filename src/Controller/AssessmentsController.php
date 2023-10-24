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

    public function review($videoId, $displayFilter = 'own')
    {

        $user = $this->Authentication->getIdentity();
        $session = $this->request->getSession();        //@todo: utiliser displayFilter pour filtrer les vidéos.
        $userId = $user ? $user->id : $session->read('User.id');

        $video = $this->Assessments->Videos->get($videoId);

        if (is_numeric($displayFilter)) {
            // display just one
            $assessementId = (int)$displayFilter;
            $assessments = $this->Assessments->findByIdAndVideoId($assessementId, $videoId);
            // $flagPoints = $this->Assessments->getAllPointsWithTiming($assessementId);
        } elseif ($displayFilter === 'all') {
            // display all assessment
            $assessments = $this->Assessments->findByVideoId($videoId);
        } else {
            // display all personal assessments
            //if ($displayFilter === 'own')
            $assessments = $this->Assessments->findByVideoIdAndUserId($videoId, $userId);
        }

        $pointsPerAssessments = [];
        foreach ($assessments as $assessment) {
            $pointsPerAssessments[$assessment->id] = $this->Assessments->getAllPointsWithTiming($assessment->id);
        }
        $this->set(compact('assessments', 'video', 'pointsPerAssessments'));
    }
}
