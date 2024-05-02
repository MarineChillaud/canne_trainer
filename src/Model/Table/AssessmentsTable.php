<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\I18n\FrozenTime;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Assessments Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\VideosTable&\Cake\ORM\Association\BelongsTo $Videos
 * @property \App\Model\Table\CommentsTable&\Cake\ORM\Association\HasMany $Comments
 * @property \App\Model\Table\PointsTable&\Cake\ORM\Association\HasMany $Points
 *
 * @method \App\Model\Entity\Assessment newEmptyEntity()
 * @method \App\Model\Entity\Assessment newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Assessment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Assessment get($primaryKey, $options = [])
 * @method \App\Model\Entity\Assessment findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Assessment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Assessment[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Assessment|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Assessment saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Assessment[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Assessment[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Assessment[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Assessment[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class AssessmentsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('assessments');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Videos', [
            'foreignKey' => 'video_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Comments', [
            'foreignKey' => 'assessment_id',
        ]);
        $this->hasMany('Points', [
            'foreignKey' => 'assessment_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('user_id')
            ->notEmptyString('user_id');

        $validator
            ->integer('video_id')
            ->notEmptyString('video_id');

        $validator
            ->dateTime('date')
            ->requirePresence('date', 'create')
            ->notEmptyDateTime('date');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn('video_id', 'Videos'), ['errorField' => 'video_id']);

        return $rules;
    }

    /**
     * returns an array of scores of the requested assessment with keys: red / blue
     */
    public function getScores($assessment_id)
    {
        $redPoints = $this->Points->findByAssessmentIdAndColor($assessment_id, 'red');
        $bluePoints = $this->Points->findByAssessmentIdAndColor($assessment_id, 'blue');
        return [
            'red' => $redPoints->count(),
            'blue' => $bluePoints->count(),
        ];
    }

    /**
     * Collects all points (red and blue) with their timing for a given assessment.
     *
     * @param int $assessmentId L'ID de l'assessment
     * @return \Cake\Datasource\ResultSetInterface Les points avec leur timing
     */
    public function getAllPointsWithTiming($assessmentId)
    {
        $points = $this->Points
            ->find()
            ->select(['color', 'timing'])
            ->where(['assessment_id' => $assessmentId])
            ->all();

        $pointsData = [];

        foreach ($points as $point) {
            $pointsData[] = [
                'color' => $point->color,
                'timing' => $point->timing
            ];
        }

        return $pointsData;
    }

    public function getAssessmentsData($video)
    {
        $data = [
            'eventTitle' => $video->event->title,
            'eventDate' => $video->event->date,
            'videoTitle' => $video->title
        ];
    
        return $data;
    }

    public function getAssessmentsCount($videoId, $userId)
    {
        $userAssessments = $this->find()
            ->where(['video_id' => $videoId, 'user_id' => $userId])
            ->count();

        $allAssessments = $this->find()
            ->where(['video_id' => $videoId])
            ->count();

        return [
            'userAssessments' => $userAssessments,
            'allAssessments' => $allAssessments,
        ];
    }

    public function add($userId, $videoId)
    {
        $newAssessment = $this->newEntity(
            [
                'user_id' => $userId,
                'video_id' => $videoId,
                'date' => FrozenTime::now(null),
            ]
        );
        $this->save($newAssessment);
        return $newAssessment;
    }
}
