<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Chmn Model
 *
 * @method \App\Model\Entity\Chmn get($primaryKey, $options = [])
 * @method \App\Model\Entity\Chmn newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Chmn[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Chmn|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Chmn|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Chmn patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Chmn[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Chmn findOrCreate($search, callable $callback = null, $options = [])
 */
class ChmnTable extends Table
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

        $this->setTable('chmn');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasOne('Mnemonics', [
            'className' => 'Mnemonics',
            'bindingKey' => 'id',
            'foreignKey' => 'reference',
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
            ->scalar('number')
            ->maxLength('number', 10)
            ->requirePresence('number', 'create')
            ->allowEmptyString('number', false);

        $validator
            ->scalar('hanzi')
            ->maxLength('hanzi', 4)
            ->requirePresence('hanzi', 'create')
            ->allowEmptyString('hanzi', false);

        $validator
            ->scalar('simplified')
            ->maxLength('simplified', 4)
            ->requirePresence('simplified', 'create')
            ->allowEmptyString('simplified', false);

        $validator
            ->scalar('mnemonics')
            ->maxLength('mnemonics', 1024)
            ->requirePresence('mnemonics', 'create')
            ->allowEmptyString('mnemonics', false);

        $validator
            ->scalar('alike')
            ->maxLength('alike', 64)
            ->requirePresence('alike', 'create')
            ->allowEmptyString('alike', false);

        $validator
            ->boolean('mine')
            ->requirePresence('mine', 'create')
            ->allowEmptyString('mine', false);

        $validator
            ->scalar('meaning')
            ->maxLength('meaning', 256)
            ->requirePresence('meaning', 'create')
            ->allowEmptyString('meaning', false);

        $validator
            ->scalar('reference')
            ->maxLength('reference', 256)
            ->requirePresence('reference', 'create')
            ->allowEmptyString('reference', false);

        $validator
            ->boolean('remnant')
            ->requirePresence('remnant', 'create')
            ->allowEmptyString('remnant', false);

        return $validator;
    }
}
