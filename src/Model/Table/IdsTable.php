<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ids Model
 *
 * @method \App\Model\Entity\Id get($primaryKey, $options = [])
 * @method \App\Model\Entity\Id newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Id[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Id|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Id|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Id patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Id[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Id findOrCreate($search, callable $callback = null, $options = [])
 */
class IdsTable extends Table
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

        $this->setTable('ids');
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
            ->maxLength('ucs', 10)
            ->allowEmptyString('ucs', 'create');

        $validator
            ->scalar('ids')
            ->maxLength('ids', 64)
            ->allowEmptyString('ids');

        return $validator;
    }
}
