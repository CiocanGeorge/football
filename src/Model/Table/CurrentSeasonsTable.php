<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CurrentSeasons Model
 *
 * @property \App\Model\Table\CompetitionsTable&\Cake\ORM\Association\HasMany $Competitions
 *
 * @method \App\Model\Entity\CurrentSeason newEmptyEntity()
 * @method \App\Model\Entity\CurrentSeason newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\CurrentSeason[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CurrentSeason get($primaryKey, $options = [])
 * @method \App\Model\Entity\CurrentSeason findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\CurrentSeason patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CurrentSeason[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\CurrentSeason|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CurrentSeason saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CurrentSeason[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CurrentSeason[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\CurrentSeason[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CurrentSeason[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CurrentSeasonsTable extends Table
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

        $this->setTable('current_seasons');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Competitions', [
            'foreignKey' => 'current_season_id',
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
            ->date('start_date')
            ->requirePresence('start_date', 'create')
            ->notEmptyDate('start_date');

        $validator
            ->date('end_date')
            ->requirePresence('end_date', 'create')
            ->notEmptyDate('end_date');

        $validator
            ->integer('current_matchday')
            ->requirePresence('current_matchday', 'create')
            ->notEmptyString('current_matchday');

        $validator
            ->scalar('winner')
            ->maxLength('winner', 255)
            ->allowEmptyString('winner');

        return $validator;
    }
}
