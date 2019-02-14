<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Alike Model
 *
 * @method \App\Model\Entity\Alike get($primaryKey, $options = [])
 * @method \App\Model\Entity\Alike newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Alike[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Alike|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Alike|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Alike patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Alike[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Alike findOrCreate($search, callable $callback = null, $options = [])
 */
class AlikeTable extends Table
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

        $this->setTable('alike');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        // $this->hasOne('Chmn', [
        //     'className' => 'Chmn',
        //     'bindingKey' => 'reference',
        //     'foreignKey' => 'id',
        // ]);
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
            ->integer('reference')
            ->requirePresence('reference', 'create')
            ->allowEmptyString('reference', false);

        $validator
            ->scalar('hanzi')
            ->maxLength('hanzi', 4)
            ->requirePresence('hanzi', 'create')
            ->allowEmptyString('hanzi', false);

        return $validator;
    }
}
