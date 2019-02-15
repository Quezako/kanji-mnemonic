<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Mnemonics Model
 *
 * @method \App\Model\Entity\Mnemonic get($primaryKey, $options = [])
 * @method \App\Model\Entity\Mnemonic newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Mnemonic[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Mnemonic|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Mnemonic|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Mnemonic patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Mnemonic[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Mnemonic findOrCreate($search, callable $callback = null, $options = [])
 */
class MnemonicsTable extends Table
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

        $this->setTable('mnemonics');
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
            ->integer('reference')
            ->requirePresence('reference', 'create')
            ->allowEmptyString('reference', false);

        $validator
            ->scalar('mnemonic')
            ->maxLength('mnemonic', 512)
            ->requirePresence('mnemonic', 'create')
            ->allowEmptyString('mnemonic', false);

        $validator
            ->integer('id')
            ->allowEmptyString('id', 'create');

        return $validator;
    }
}
