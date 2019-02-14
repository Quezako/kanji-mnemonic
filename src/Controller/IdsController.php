<?php
namespace App\Controller;

use App\Controller\AppController;
use Rest\Controller\RestController;

/**
 * Ids Controller
 *
 * @property \App\Model\Table\IdsTable $Ids
 *
 * @method \App\Model\Entity\Id[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
// class IdsController extends AppController
class IdsController extends RestController
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
                    $conditions[] = ["BINARY $column LIKE" => "%$value%"];
                } else {
                    $conditions[] = ["$column =" => $value];
                }
            }
        }

        $conditions[] = ["(LENGTH(ucs) % 2) =" => 0];

        ${lcfirst($this->name)} = $this->paginate($this->name, [
			'conditions' => $conditions,
		]);

        foreach (${lcfirst($this->name)} as $key => $value) {
            $len = strlen($value->ucs);
            $value->ucs = iconv('UTF-16BE', 'UTF-8', hex2bin($value->ucs));
            $value->label = $value->ids;
        }

        $this->set(compact(lcfirst($this->name)));
    }

    /**
     * View method
     *
     * @param string|null $id Id id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $id = $this->Ids->get($id, [
            'contain' => []
        ]);

        $this->set('id', $id);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $id = $this->Ids->newEntity();
        if ($this->request->is('post')) {
            $id = $this->Ids->patchEntity($id, $this->request->getData());
            if ($this->Ids->save($id)) {
                $this->Flash->success(__('The id has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The id could not be saved. Please, try again.'));
        }
        $this->set(compact('id'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Id id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $id = $this->Ids->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $id = $this->Ids->patchEntity($id, $this->request->getData());
            if ($this->Ids->save($id)) {
                $this->Flash->success(__('The id has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The id could not be saved. Please, try again.'));
        }
        $this->set(compact('id'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Id id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $id = $this->Ids->get($id);
        if ($this->Ids->delete($id)) {
            $this->Flash->success(__('The id has been deleted.'));
        } else {
            $this->Flash->error(__('The id could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
