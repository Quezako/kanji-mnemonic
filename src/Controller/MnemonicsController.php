<?php
namespace App\Controller;

use App\Controller\AppController;
use Rest\Controller\RestController;

/**
 * Mnemonics Controller
 *
 * @property \App\Model\Table\MnemonicsTable $Mnemonics
 *
 * @method \App\Model\Entity\Mnemonic[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
// class MnemonicsController extends AppController
class MnemonicsController extends RestController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $conditions = [];

        foreach ($this->request->query as $column => $value) {
            if (in_array($column, $this->{$this->name}->schema()->columns())) {
                if ($this->{$this->name}->schema()->typeMap()[$column] === 'string') {
                    $conditions[] = ["BINARY alike.$column LIKE" => "$value%"];
                } else {
                    $conditions[] = ["$column =" => $value];
                }
            }
        }

        ${lcfirst($this->name)} = $this->paginate($this->name, [
            'conditions' => $conditions,
        ]);

        $this->set(compact(lcfirst($this->name)));
    }

    /**
     * View method
     *
     * @param string|null $id Mnemonic id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mnemonic = $this->Mnemonics->get($id, [
            'contain' => []
        ]);

        $this->set('mnemonic', $mnemonic);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mnemonic = $this->Mnemonics->newEntity();
        if ($this->request->is('post')) {
            $mnemonic = $this->Mnemonics->patchEntity($mnemonic, $this->request->getData());
            if ($this->Mnemonics->save($mnemonic)) {
                $this->Flash->success(__('The mnemonic has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The mnemonic could not be saved. Please, try again.'));
        }
        $this->set(compact('mnemonic'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Mnemonic id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mnemonic = $this->Mnemonics->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mnemonic = $this->Mnemonics->patchEntity($mnemonic, $this->request->getData());
            if ($this->Mnemonics->save($mnemonic)) {
                $this->Flash->success(__('The mnemonic has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The mnemonic could not be saved. Please, try again.'));
        }
        $this->set(compact('mnemonic'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Mnemonic id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mnemonic = $this->Mnemonics->get($id);
        if ($this->Mnemonics->delete($mnemonic)) {
            $this->Flash->success(__('The mnemonic has been deleted.'));
        } else {
            $this->Flash->error(__('The mnemonic could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
