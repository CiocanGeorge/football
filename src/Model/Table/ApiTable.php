<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * Api Model
 *
 * @method \App\Model\Entity\Api newEmptyEntity()
 * @method \App\Model\Entity\Api newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Api[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Api get($primaryKey, $options = [])
 * @method \App\Model\Entity\Api findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Api patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Api[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Api|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Api saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Api[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Api[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Api[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Api[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ApiTable extends Table
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

        $this->setTable('api');
        $this->setDisplayField('apiKey');
        $this->setPrimaryKey('id');
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
            ->scalar('apiKey')
            ->maxLength('apiKey', 255)
            ->requirePresence('apiKey', 'create')
            ->notEmptyString('apiKey');

        return $validator;
    }
    public static function getObject() {
        return TableRegistry::getTableLocator()->get('api');
    }

    public static function getApi()
    {
        return self::getObject()->find()->first()['apiKey'];
    }
}
