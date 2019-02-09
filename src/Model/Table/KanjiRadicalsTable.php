<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * KanjiRadicals Model
 *
 * @property \App\Model\Table\RadicalsTable|\Cake\ORM\Association\BelongsTo $Radicals
 *
 * @method \App\Model\Entity\KanjiRadical get($primaryKey, $options = [])
 * @method \App\Model\Entity\KanjiRadical newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\KanjiRadical[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\KanjiRadical|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\KanjiRadical|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\KanjiRadical patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\KanjiRadical[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\KanjiRadical findOrCreate($search, callable $callback = null, $options = [])
 */
class KanjiRadicalsTable extends Table
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

        $this->setTable('kanji_radicals');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Radicals', [
            'foreignKey' => 'radical_id',
            'joinType' => 'INNER'
        ]);
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
            ->integer('kanji_grade')
            ->allowEmptyString('kanji_grade');

        $validator
            ->integer('kanji_strokes')
            ->allowEmptyString('kanji_strokes');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['radical_id'], 'Radicals'));

        return $rules;
    }
}
