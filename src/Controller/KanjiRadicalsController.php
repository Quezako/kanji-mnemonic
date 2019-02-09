<?php
namespace App\Controller;

// use App\Controller\AppController;
use Rest\Controller\RestController;

/**
 * KanjiRadicals Controller
 *
 * @property \App\Model\Table\KanjiRadicalsTable $KanjiRadicals
 *
 * @method \App\Model\Entity\KanjiRadical[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class KanjiRadicalsController extends RestController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Radicals']
        ];
        $kanjiRadicals = $this->paginate($this->KanjiRadicals);

        $this->set(compact('kanjiRadicals'));
    }

    /**
     * View method
     *
     * @param string|null $id Kanji Radical id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $kanjiRadical = $this->KanjiRadicals->get($id, [
            'contain' => ['Radicals']
        ]);

        $this->set('kanjiRadical', $kanjiRadical);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $kanjiRadical = $this->KanjiRadicals->newEntity();
        if ($this->request->is('post')) {
            $kanjiRadical = $this->KanjiRadicals->patchEntity($kanjiRadical, $this->request->getData());
            if ($this->KanjiRadicals->save($kanjiRadical)) {
                $this->Flash->success(__('The kanji radical has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The kanji radical could not be saved. Please, try again.'));
        }
        $radicals = $this->KanjiRadicals->Radicals->find('list', ['limit' => 200]);
        $this->set(compact('kanjiRadical', 'radicals'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Kanji Radical id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $kanjiRadical = $this->KanjiRadicals->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $kanjiRadical = $this->KanjiRadicals->patchEntity($kanjiRadical, $this->request->getData());
            if ($this->KanjiRadicals->save($kanjiRadical)) {
                $this->Flash->success(__('The kanji radical has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The kanji radical could not be saved. Please, try again.'));
        }
        $radicals = $this->KanjiRadicals->Radicals->find('list', ['limit' => 200]);
        $this->set(compact('kanjiRadical', 'radicals'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Kanji Radical id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $kanjiRadical = $this->KanjiRadicals->get($id);
        if ($this->KanjiRadicals->delete($kanjiRadical)) {
            $this->Flash->success(__('The kanji radical has been deleted.'));
        } else {
            $this->Flash->error(__('The kanji radical could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
