<?php
namespace App\Controller;

// use App\Controller\AppController;
use Rest\Controller\RestController;

/**
 * KanjiMeanings Controller
 *
 * @property \App\Model\Table\KanjiMeaningsTable $KanjiMeanings
 *
 * @method \App\Model\Entity\KanjiMeaning[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class KanjiMeaningsController extends RestController
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
            if (in_array($column, $this->Chmn->schema()->columns())) {
                $conditions[] = ["$column LIKE" => "%$value%"];
            }
        }

        $kanjiMeanings = $this->paginate($this->KanjiMeanings);

        $this->set(compact('kanjiMeanings'));
    }

    /**
     * View method
     *
     * @param string|null $id Kanji Meaning id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $kanjiMeaning = $this->KanjiMeanings->get($id, [
            'contain' => []
        ]);

        $this->set('kanjiMeaning', $kanjiMeaning);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $kanjiMeaning = $this->KanjiMeanings->newEntity();
        if ($this->request->is('post')) {
            $kanjiMeaning = $this->KanjiMeanings->patchEntity($kanjiMeaning, $this->request->getData());
            if ($this->KanjiMeanings->save($kanjiMeaning)) {
                $this->Flash->success(__('The kanji meaning has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The kanji meaning could not be saved. Please, try again.'));
        }
        $this->set(compact('kanjiMeaning'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Kanji Meaning id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $kanjiMeaning = $this->KanjiMeanings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $kanjiMeaning = $this->KanjiMeanings->patchEntity($kanjiMeaning, $this->request->getData());
            if ($this->KanjiMeanings->save($kanjiMeaning)) {
                $this->Flash->success(__('The kanji meaning has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The kanji meaning could not be saved. Please, try again.'));
        }
        $this->set(compact('kanjiMeaning'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Kanji Meaning id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $kanjiMeaning = $this->KanjiMeanings->get($id);
        if ($this->KanjiMeanings->delete($kanjiMeaning)) {
            $this->Flash->success(__('The kanji meaning has been deleted.'));
        } else {
            $this->Flash->error(__('The kanji meaning could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
