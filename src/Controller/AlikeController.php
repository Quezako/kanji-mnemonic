<?php
namespace App\Controller;

// use App\Controller\AppController;
use Rest\Controller\RestController;

/**
 * Alike Controller
 *
 * @property \App\Model\Table\AlikeTable $Alike
 *
 * @method \App\Model\Entity\Alike[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AlikeController extends RestController
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
                    $conditions[] = ["$column LIKE" => "$value%"];
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
     * @param string|null $id Alike id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $alike = $this->Alike->get($id, [
            'contain' => []
        ]);

        $this->set('alike', $alike);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $alike = $this->Alike->newEntity();
        if ($this->request->is('post')) {
            $alike = $this->Alike->patchEntity($alike, $this->request->getData());
            if ($this->Alike->save($alike)) {
                $this->Flash->success(__('The alike has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The alike could not be saved. Please, try again.'));
        }
        $this->set(compact('alike'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Alike id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $alike = $this->Alike->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $alike = $this->Alike->patchEntity($alike, $this->request->getData());
            if ($this->Alike->save($alike)) {
                $this->Flash->success(__('The alike has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The alike could not be saved. Please, try again.'));
        }
        $this->set(compact('alike'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Alike id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $alike = $this->Alike->get($id);
        if ($this->Alike->delete($alike)) {
            $this->Flash->success(__('The alike has been deleted.'));
        } else {
            $this->Flash->error(__('The alike could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
