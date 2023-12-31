<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\Assessment;
use Cake\Event\EventInterface;


/**
 * Assessments Controller
 *
 * @property \App\Model\Table\AssessmentsTable $Assessments
 * @method \App\Model\Entity\Assessment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AssessmentsController extends AppController
{

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->getRequest()->getAttribute('csrfToken');
        $this->Authentication->allowUnauthenticated(['review']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $videos = $this->Assessments->Videos->find('all', ['contain' => 'Events']);

        $user = $this->Authentication->getIdentity();
        $userId=$user->id;

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

    public function review($videoId, $displayFilter = 'own')
    {

        $user = $this->Authentication->getIdentity();
        $userId=$user->id;

        $video = $this->Assessments->Videos->get($videoId);

        if (is_numeric($displayFilter)) {
            // display just one
            $assessementId = (int)$displayFilter;
            $assessments = $this->Assessments->findByIdAndVideoId($assessementId, $videoId);
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

        $allFlagPoints = [];
        foreach ($assessments as $assessment) {
            $points = $this->Assessments->getAllPointsWithTiming($assessment->id);
            foreach ($points as $point) {
                $allFlagPoints[] = $point;
            }
        }
        
        $this->set(compact('assessments', 'video', 'pointsPerAssessments', 'allFlagPoints'));
    }
}
