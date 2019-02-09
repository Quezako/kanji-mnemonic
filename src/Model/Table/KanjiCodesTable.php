<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * KanjiCodes Model
 *
 * @method \App\Model\Entity\KanjiCode get($primaryKey, $options = [])
 * @method \App\Model\Entity\KanjiCode newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\KanjiCode[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\KanjiCode|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\KanjiCode|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\KanjiCode patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\KanjiCode[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\KanjiCode findOrCreate($search, callable $callback = null, $options = [])
 */
class KanjiCodesTable extends Table
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

        $this->setTable('kanji_codes');
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
            ->scalar('section')
            ->maxLength('section', 16)
            ->allowEmptyString('section');

        $validator
            ->scalar('type')
            ->maxLength('type', 16)
            ->requirePresence('type', 'create')
            ->allowEmptyString('type', false);

        $validator
            ->scalar('value')
            ->maxLength('value', 16)
            ->requirePresence('value', 'create')
            ->allowEmptyString('value', false);

        return $validator;
    }
}
