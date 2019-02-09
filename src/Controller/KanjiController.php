<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Kanji Controller
 *
 * @property \App\Model\Table\KanjiTable $Kanji
 *
 * @method \App\Model\Entity\Kanji[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class KanjiController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $kanji = $this->paginate($this->Kanji);

        $this->set(compact('kanji'));
    }

    /**
     * View method
     *
     * @param string|null $id Kanji id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $kanji = $this->Kanji->get($id, [
            'contain' => []
        ]);

        $this->set('kanji', $kanji);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $kanji = $this->Kanji->newEntity();
        if ($this->request->is('post')) {
            $kanji = $this->Kanji->patchEntity($kanji, $this->request->getData());
            if ($this->Kanji->save($kanji)) {
                $this->Flash->success(__('The kanji has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The kanji could not be saved. Please, try again.'));
        }
        $this->set(compact('kanji'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Kanji id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $kanji = $this->Kanji->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $kanji = $this->Kanji->patchEntity($kanji, $this->request->getData());
            if ($this->Kanji->save($kanji)) {
                $this->Flash->success(__('The kanji has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The kanji could not be saved. Please, try again.'));
        }
        $this->set(compact('kanji'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Kanji id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $kanji = $this->Kanji->get($id);
        if ($this->Kanji->delete($kanji)) {
            $this->Flash->success(__('The kanji has been deleted.'));
        } else {
            $this->Flash->error(__('The kanji could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
