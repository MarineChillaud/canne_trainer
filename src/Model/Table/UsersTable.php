<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\I18n\FrozenTime;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;use Cake\Mailer\Mailer;


/**
 * Users Model
 *
 * @property \App\Model\Table\AssessmentsTable&\Cake\ORM\Association\HasMany $Assessments
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Assessments', [
            'foreignKey' => 'user_id',
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
            ->scalar('username')
            ->maxLength('username', 255)
            ->requirePresence('username', 'create')
            ->notEmptyString('username');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmptyString('password');

        $validator
            ->scalar('lastName')
            ->maxLength('lastName', 255)
            ->requirePresence('lastName', 'create')
            ->notEmptyString('lastName');

        $validator
            ->scalar('firstName')
            ->maxLength('firstName', 255)
            ->requirePresence('firstName', 'create')
            ->notEmptyString('firstName');

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
        $rules->add($rules->isUnique(['username']), ['errorField' => 'username']);

        return $rules;
    }

    public function addAnonymous()
    {
        $newUser = $this->newEntity([
            'username' => 'username_' . substr(md5(uniqid()), 0, 6),
            'password' => bin2hex(random_bytes(8)),
            'firstName' => 'firsname_' . substr(md5(uniqid()), 0, 6),
            'lastName' => 'lastname_' . substr(md5(uniqid()), 0, 6),
            'created' => FrozenTime::now(),
        ]);
        $this->save($newUser);
        return $newUser;
    }

    private function generateRandomPassword()
    {
        $length = 10; // Longueur du mot de passe
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789&#?;:!';
        $password = '';

        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $password;
    }

    private function sendPasswordEmail($recipientEmail, $newPassword)
    {
        if (!empty($recipientEmail)) {
            $mailer = new Mailer('default');
            $mailer
                ->setTo($recipientEmail)
                ->setSubject('Nouveau mot de passe')
                ->setEmailFormat('text')
                ->deliver(
                    'Bonjour, \n\n' .
                        'Votre nouveau mot de passe est : ' . $newPassword . '\n' .
                        'Merci de vous connecter avec ce nouveau mot de passe et de le changer dès que possible. \n\n' .
                        'Canne Trainer'
                );
        }
    }
}
