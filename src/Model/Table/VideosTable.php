<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\API\ApiCaller;

/**
 * Videos Model
 *
 * @property \App\Model\Table\EventsTable&\Cake\ORM\Association\BelongsTo $Events
 * @property \App\Model\Table\AssessmentsTable&\Cake\ORM\Association\HasMany $Assessments
 *
 * @method \App\Model\Entity\Video newEmptyEntity()
 * @method \App\Model\Entity\Video newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Video[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Video get($primaryKey, $options = [])
 * @method \App\Model\Entity\Video findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Video patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Video[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Video|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Video saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Video[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Video[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Video[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Video[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class VideosTable extends Table
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

        $this->setTable('videos');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->belongsTo('Events', [
            'foreignKey' => 'event_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Assessments', [
            'foreignKey' => 'video_id',
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
            ->integer('event_id')
            ->notEmptyString('event_id');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('url')
            ->notEmptyString('url');

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
        $rules->add($rules->existsIn('event_id', 'Events'), ['errorField' => 'event_id']);

        return $rules;
    }

    protected function callApi(string $url):array
    {
        return json_decode(file_get_contents($url), true);
    }

    public function updateFromApi(int $eventId)
    {
        $apiCaller = new ApiCaller();
        $encounterDatas = $apiCaller->getEncounterDatas($eventId);

        foreach ($encounterDatas as $encounterData) {
            $encounterDetails = $apiCaller->getEncounterDetails($encounterData['id']);

            if(isset($encounterDetails['error']))
            {
                //en cas d'erreur dans l'api on integre pas la vidéo
                continue; // le "continue" permet de court-circuiter la boucle 
            }
            $url='';
            $offset=0;
            $fileList=$encounterDetails['fileInfoList'];
            if(count($fileList)>=1)
            {
                //@todo: attention si plusieur vidéos, cas non traité
                $url=$fileList[0]['filePath'];
                $offset=$fileList[0]['offsetInSeconds'];
            }else{
                $oldEncounterDetails = $this->callApi('https://canne.tv/replay/link_provider.php?id='.$encounterData['id']);
                if(!isset($oldEncounterDetails['error'])){
                    $url=  "https://canne.tv/replay/".$oldEncounterDetails['fileName'];
                }
            }
            $video = $this->newEntity( [
                'id' => $encounterData['id'],
                'event_id' => $eventId,
                'title' => $encounterData['name'],
                'url' => $url,
                'offset' => $offset,
                'date' => $encounterData['startTime'],
                ], [
                'accessibleFields'=>['id'=>true]
                ]
            );
            if($url!=='')
            {
                if(!$this->save($video)){
                    pr($video);
                }
            }
        }
    }
}
