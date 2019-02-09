<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Kanji Model
 *
 * @method \App\Model\Entity\Kanji get($primaryKey, $options = [])
 * @method \App\Model\Entity\Kanji newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Kanji[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Kanji|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Kanji|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Kanji patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Kanji[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Kanji findOrCreate($search, callable $callback = null, $options = [])
 */
class KanjiTable extends Table
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

        $this->setTable('kanji');
        $this->setDisplayField('ucs');
        $this->setPrimaryKey('ucs');
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
            ->scalar('ucs')
            ->maxLength('ucs', 6)
            ->allowEmptyString('ucs', 'create');

        $validator
            ->scalar('kanji')
            ->maxLength('kanji', 8)
            ->requirePresence('kanji', 'create')
            ->allowEmptyString('kanji', false);

        $validator
            ->integer('jlpt')
            ->allowEmptyString('jlpt');

        $validator
            ->integer('grade')
            ->allowEmptyString('grade');

        $validator
            ->integer('strokes')
            ->allowEmptyString('strokes');

        $validator
            ->scalar('data')
            ->requirePresence('data', 'create')
            ->allowEmptyString('data', false);

        return $validator;
    }
}
