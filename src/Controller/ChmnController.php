<?php
namespace App\Controller;

use App\Controller\AppController;
use Rest\Controller\RestController;

/**
 * Chmn Controller
 *
 * @property \App\Model\Table\ChmnTable $Chmn
 *
 * @method \App\Model\Entity\Chmn[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
// class ChmnController extends AppController
class ChmnController extends RestController
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
                    if ($column == 'hanzi') {
                        $conditions[] = [
                            'OR' => [
                                "BINARY $column LIKE" => "$value%",
                                "BINARY simplified LIKE" => "$value%",
                                "BINARY alike LIKE" => "$value%",
                            ]
                        ];
                    } else {
                        $conditions[] = ["$column LIKE" => "$value%"];
                    }
                } else {
                    $conditions[] = ["$column =" => $value];
                }
            }
        }

        $conditions[] = ["mine =" => 1];

        ${lcfirst($this->name)} = $this->paginate($this->name, [
            'conditions' => $conditions,
            'fields' => [
                'hanzi',
                'simplified',
                'alike',
                'meaning',
                'reference',
                'ucs' => 'chmn.hanzi',
                'label' => 'chmn.meaning',
                // 'mnemonics',
                'mnemonics' => 'CONCAT("- ", GROUP_CONCAT(mnemonics.mnemonic SEPARATOR "<br />- "))',
                // 'mnemonics' => 'CONCAT("<ul><li>", GROUP_CONCAT(mnemonics.mnemonic SEPARATOR "</li><li>"), "</li></ul>")',
            ],
            'contain' => ['Mnemonics']
        ]);

        $this->set(compact(lcfirst($this->name)));
    }

    /**
     * View method
     *
     * @param string|null $id Chmn id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $chmn = $this->Chmn->get($id, [
            'contain' => []
        ]);

        $this->set('chmn', $chmn);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $chmn = $this->Chmn->newEntity();
        if ($this->request->is('post')) {
            $chmn = $this->Chmn->patchEntity($chmn, $this->request->getData());
            if ($this->Chmn->save($chmn)) {
                $this->Flash->success(__('The chmn has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The chmn could not be saved. Please, try again.'));
        }
        $this->set(compact('chmn'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Chmn id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $chmn = $this->Chmn->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $chmn = $this->Chmn->patchEntity($chmn, $this->request->getData());
            if ($this->Chmn->save($chmn)) {
                $this->Flash->success(__('The chmn has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The chmn could not be saved. Please, try again.'));
        }
        $this->set(compact('chmn'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Chmn id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $chmn = $this->Chmn->get($id);
        if ($this->Chmn->delete($chmn)) {
            $this->Flash->success(__('The chmn has been deleted.'));
        } else {
            $this->Flash->error(__('The chmn could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
