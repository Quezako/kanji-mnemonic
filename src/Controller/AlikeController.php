<?php
namespace App\Controller;

use App\Controller\AppController;


/**
 * Alike Controller
 *
 * @property \App\Model\Table\AlikeTable $Alike
 *
 * @method \App\Model\Entity\Alike[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
// class AlikeController extends AppController
class AlikeController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        try {
            $conditions = [];

            foreach ($this->request->getQuery() as $column => $value) {
                if (in_array($column, $this->{$this->name}->getSchema()->columns())) {
                    if ($this->{$this->name}->getSchema()->typeMap()[$column] === 'string') {
                        $conditions[] = ["Alike.$column LIKE" => "$value%"];
                    } else {
                        $conditions[] = ["Alike.$column =" => $value];
                    }
                }
            }

            ${lcfirst($this->name)} = $this->paginate($this->name, [
                'conditions' => $conditions,
            ]);

            $this->disableAutoRender();
            $this->response = $this->response->withType('application/json');
            $this->response = $this->response->withStringBody(json_encode([
                'result' => [
                    lcfirst($this->name) => ${lcfirst($this->name)}
                ]
            ]));
            return $this->response;
        } catch (\Exception $e) {
            $this->disableAutoRender();
            $this->response = $this->response->withType('application/json');
            $this->response = $this->response->withStringBody(json_encode(['error' => $e->getMessage()]));
            return $this->response;
        }
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
