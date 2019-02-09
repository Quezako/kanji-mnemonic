<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * KanjiReadings Model
 *
 * @method \App\Model\Entity\KanjiReading get($primaryKey, $options = [])
 * @method \App\Model\Entity\KanjiReading newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\KanjiReading[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\KanjiReading|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\KanjiReading|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\KanjiReading patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\KanjiReading[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\KanjiReading findOrCreate($search, callable $callback = null, $options = [])
 */
class KanjiReadingsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('kanji_readings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('ucs')
            ->maxLength('ucs', 6)
            ->requirePresence('ucs', 'create')
            ->allowEmptyString('ucs', false);

        $validator
            ->scalar('type')
            ->maxLength('type', 16)
            ->requirePresence('type', 'create')
            ->allowEmptyString('type', false);

        $validator
            ->scalar('reading')
            ->maxLength('reading', 64)
            ->requirePresence('reading', 'create')
            ->allowEmptyString('reading', false);

        return $validator;
    }
}
