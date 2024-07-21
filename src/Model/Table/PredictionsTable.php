<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * Predictions Model
 *
 * @method \App\Model\Entity\Prediction newEmptyEntity()
 * @method \App\Model\Entity\Prediction newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Prediction[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Prediction get($primaryKey, $options = [])
 * @method \App\Model\Entity\Prediction findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Prediction patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Prediction[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Prediction|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Prediction saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Prediction[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Prediction[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Prediction[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Prediction[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PredictionsTable extends Table
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

        $this->setTable('predictions');
        $this->setDisplayField('id');
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
            ->integer('matchId')
            ->requirePresence('matchId', 'create')
            ->notEmptyString('matchId');

        $validator
            ->scalar('over2')
            ->maxLength('over2', 50)
            ->allowEmptyString('over2');

        $validator
            ->scalar('under2')
            ->maxLength('under2', 50)
            ->allowEmptyString('under2');

        $validator
            ->scalar('over0')
            ->maxLength('over0', 255)
            ->allowEmptyString('over0');

        $validator
            ->scalar('under0')
            ->maxLength('under0', 255)
            ->allowEmptyString('under0');

        return $validator;
    }
    public static function getObject() {
        return TableRegistry::getTableLocator()->get('predictions');
    }

    public static function getByMatchId($matchId)
    {
        $query = self::getObject()->find()->where(['matchId' => $matchId])->first();

        return $query;
    }

    public static function getOver0($arrayMatch)
    {
        $predictions = [];
        foreach($arrayMatch as $key => $match)
        {
            if($key == 5)
            {
                break;
            }
            $predictions[$key] = $match['scores']['full_time_home'] + $match['scores']['full_time_away'];
        }
        $procent = 0;
        foreach($predictions as $key => $pred)
        {
           $procent += $pred>=1 ? 100 : 0;
        }
        $procent = $procent/count($predictions);

        return $procent;
    }

    public static function getOver1($arrayMatch)
    {
        $predictions = [];
        foreach($arrayMatch as $key => $match)
        {
            if($key == 5)
            {
                break;
            }
            $predictions[$key] = $match['scores']['full_time_home'] + $match['scores']['full_time_away'];
        }
        $procent = 0;
        foreach($predictions as $key => $pred)
        {
           $procent += $pred>=2 ? 100 : 0;
        }
        $procent = $procent/count($predictions);

        return $procent;
    }

    public static function getOver2($arrayMatch)
    {
        $predictions = [];
        foreach($arrayMatch as $key => $match)
        {
            if($key == 5)
            {
                break;
            }
            $predictions[$key] = $match['scores']['full_time_home'] + $match['scores']['full_time_away'];
        }
        $procent = 0;
        foreach($predictions as $key => $pred)
        {
           $procent += $pred>2 ? 100 : 0;
        }
        $procent = $procent/count($predictions);

        return $procent;
    }

    public static function getOver0FirstHalf($arrayMatch)
    {
        $predictions = [];
        foreach($arrayMatch as $key => $match)
        {
            if($key == 5)
            {
                break;
            }
            $predictions[$key] = $match['scores']['half_time_home'] + $match['scores']['half_time_away'];
        }
        $procent = 0;
        foreach($predictions as $key => $pred)
        {
           $procent += $pred>0 ? 100 : 0;
        }
        $procent = $procent/count($predictions);

        return $procent;
    }

    public static function getGG($arrayMatch)
    {
        $predictions = [];
        foreach($arrayMatch as $key => $match)
        {
            if($key == 5)
            {
                break;
            }
            $predictions[$key] = ($match['scores']['full_time_home'] > 0) && ($match['scores']['full_time_away'] > 0);
        }
        $procent = 0;
        foreach($predictions as $key => $pred)
        {
           $procent += $pred ? 100 : 0;
        }
        $procent = $procent/count($predictions);

        return $procent;
    }
}
