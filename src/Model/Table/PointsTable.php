<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Points Model
 *
 * @property \App\Model\Table\AssessmentsTable&\Cake\ORM\Association\BelongsTo $Assessments
 *
 * @method \App\Model\Entity\Point newEmptyEntity()
 * @method \App\Model\Entity\Point newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Point[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Point get($primaryKey, $options = [])
 * @method \App\Model\Entity\Point findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Point patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Point[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Point|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Point saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Point[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Point[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Point[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Point[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PointsTable extends Table
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

        $this->setTable('points');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Assessments', [
            'foreignKey' => 'assessment_id',
            'joinType' => 'INNER',
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
            ->integer('assessment_id')
            ->notEmptyString('assessment_id');

        $validator
            ->scalar('color')
            ->maxLength('color', 255)
            ->requirePresence('color', 'create')
            ->notEmptyString('color');

        $validator
            ->numeric('timing')
            ->allowEmptyString('timing');

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
        $rules->add($rules->existsIn('assessment_id', 'Assessments'), ['errorField' => 'assessment_id']);

        return $rules;
    }
    /**
     * add a point in database
     */
    public function addColorPoint($videoId, $assessmentId, $color, $timing)
    {
        $newPoint = $this->newEmptyEntity();
        $newPoint->video_id = $videoId;
        $newPoint->assessment_id = $assessmentId;
        $newPoint->color = $color;
        $newPoint->timing = $timing;
        $this->save($newPoint);
    }
}
