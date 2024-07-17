<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * Matches Model
 *
 * @property \App\Model\Table\AreasTable&\Cake\ORM\Association\BelongsTo $Areas
 * @property \App\Model\Table\CompetitionsTable&\Cake\ORM\Association\BelongsTo $Competitions
 *
 * @method \App\Model\Entity\Match newEmptyEntity()
 * @method \App\Model\Entity\Match newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Match[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Match get($primaryKey, $options = [])
 * @method \App\Model\Entity\Match findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Match patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Match[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Match|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Match saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Match[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Match[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Match[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Match[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class MatchesTable extends Table
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

        $this->setTable('matches');
        $this->setDisplayField('status');
        $this->setPrimaryKey('id');

        $this->belongsTo('Areas', [
            'foreignKey' => 'areaId',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Competitions', [
            'foreignKey' => 'competitionId',
            'joinType' => 'INNER',
        ]);

        $this->hasOne('Scores', [
            'foreignKey' => 'match_id',
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
            ->dateTime('utcDate')
            ->requirePresence('utcDate', 'create')
            ->notEmptyDateTime('utcDate');

        $validator
            ->scalar('status')
            ->maxLength('status', 50)
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

        $validator
            ->integer('matchday')
            ->allowEmptyString('matchday');

        $validator
            ->scalar('stage')
            ->maxLength('stage', 50)
            ->allowEmptyString('stage');

        $validator
            ->dateTime('lastUpdated')
            ->requirePresence('lastUpdated', 'create')
            ->notEmptyDateTime('lastUpdated');

        $validator
            ->integer('homeTeamId')
            ->requirePresence('homeTeamId', 'create')
            ->notEmptyString('homeTeamId');

        $validator
            ->integer('awayTeamId')
            ->requirePresence('awayTeamId', 'create')
            ->notEmptyString('awayTeamId');

        $validator
            ->integer('areaId')
            ->notEmptyString('areaId');

        $validator
            ->integer('competitionId')
            ->notEmptyString('competitionId');

        $validator
            ->integer('seasonId')
            ->requirePresence('seasonId', 'create')
            ->notEmptyString('seasonId');

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
        $rules->add($rules->existsIn('areaId', 'Areas'), ['errorField' => 'areaId']);
        $rules->add($rules->existsIn('competitionId', 'Competitions'), ['errorField' => 'competitionId']);

        return $rules;
    }

    public static function getObject()
    {
        return TableRegistry::getTableLocator()->get('matches');
    }

    public static function getByDate($date)
    {

        if (empty($date)) {
            $date = date("Y-m-d");
        }
        $results = self::getObject()->find()
            ->select([
                'Matches.id',
                'Matches.utcDate',
                'Matches.status',
                'Matches.homeTeamId',
                'Matches.awayTeamId',
                'Matches.homeName',
                'Matches.awayName',
                'Matches.homeLogo',
                'Matches.awayLogo',
                'Scores.full_time_home',
                'Scores.full_time_away',
                'Scores.half_time_home',
                'Scores.half_time_away',
            ])
            ->innerJoin(
                ['Scores' => 'scores'],
                ['Scores.match_id = Matches.id']
            )
            ->where(['matches.utcDate LIKE' => $date . '%']); // Utilizăm LIKE pentru coloana utcDate
        return $results->toArray();
    }

    public static function getLast5Match($homeTeamId, $awayTeamId)
    {
        $results = self::getObject()->find()
            ->select([
                'Matches.id',
                'Matches.utcDate',
                'Matches.status',
                'Scores.full_time_home',
                'Scores.full_time_away',
                'Scores.half_time_home',
                'Scores.half_time_away',
            ])
            ->innerJoin(
                ['Scores' => 'scores'], // Specificăm tabela Scores și aliasul său
                ['Scores.match_id = Matches.id']
            ) // Condiția pentru INNER JOIN) // Adăugăm tabela Scores în interogare pentru INNER JOIN
            ->where([
                'OR' => [
                    [
                        'Matches.homeTeamId' => $homeTeamId,
                        'Matches.awayTeamId' => $awayTeamId
                    ],
                    [
                        'Matches.homeTeamId' => $awayTeamId,
                        'Matches.awayTeamId' => $homeTeamId
                    ]
                ],
                'Scores.full_time_home IS NOT NULL'
            ])->orderDesc("matches.utcDate"); // Utilizăm LIKE pentru coloana utcDate
        return $results->toArray();
    }
}
