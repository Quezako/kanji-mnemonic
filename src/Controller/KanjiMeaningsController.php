<?php
namespace App\Controller;

use App\Controller\AppController;
use Rest\Controller\RestController;

/**
 * KanjiMeanings Controller
 *
 * @property \App\Model\Table\KanjiMeaningsTable $KanjiMeanings
 *
 * @method \App\Model\Entity\KanjiMeaning[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
// class KanjiMeaningsController extends AppController
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

        foreach (${lcfirst($this->name)} as $key => $value) {
            $len = strlen($value->ucs);

            if ($len % 2) {
                $value->ucs = '?';
            } else {
                $value->ucs = iconv('UTF-16BE', 'UTF-8', hex2bin($value->ucs));
            }

            $value->label = $value->meaning;
        }

        $this->set(compact(lcfirst($this->name)));
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
