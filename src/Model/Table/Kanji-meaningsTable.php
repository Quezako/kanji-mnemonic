<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Kanji-meanings Model
 *
 * @method \App\Model\Entity\Kanji-meaning get($primaryKey, $options = [])
 * @method \App\Model\Entity\Kanji-meaning newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Kanji-meaning[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Kanji-meaning|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Kanji-meaning|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Kanji-meaning patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Kanji-meaning[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Kanji-meaning findOrCreate($search, callable $callback = null, $options = [])
 */
class Kanji-meaningsTable extends Table
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

        $this->setTable('kanji_meanings');
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
            ->scalar('language')
            ->maxLength('language', 4)
            ->requirePresence('language', 'create')
            ->allowEmptyString('language', false);

        $validator
            ->scalar('meaning')
            ->maxLength('meaning', 128)
            ->requirePresence('meaning', 'create')
            ->allowEmptyString('meaning', false);

        return $validator;
    }
}
