<?php
namespace App\Controller;

// use App\Controller\AppController;
use Rest\Controller\RestController;

/**
 * KanjiReadings Controller
 *
 * @property \App\Model\Table\KanjiReadingsTable $KanjiReadings
 *
 * @method \App\Model\Entity\KanjiReading[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class KanjiReadingsController extends RestController
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
     * @param string|null $id Kanji Reading id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $kanjiReading = $this->KanjiReadings->get($id, [
            'contain' => []
        ]);

        $this->set('kanjiReading', $kanjiReading);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $kanjiReading = $this->KanjiReadings->newEntity();
        if ($this->request->is('post')) {
            $kanjiReading = $this->KanjiReadings->patchEntity($kanjiReading, $this->request->getData());
            if ($this->KanjiReadings->save($kanjiReading)) {
                $this->Flash->success(__('The kanji reading has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The kanji reading could not be saved. Please, try again.'));
        }
        $this->set(compact('kanjiReading'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Kanji Reading id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $kanjiReading = $this->KanjiReadings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $kanjiReading = $this->KanjiReadings->patchEntity($kanjiReading, $this->request->getData());
            if ($this->KanjiReadings->save($kanjiReading)) {
                $this->Flash->success(__('The kanji reading has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The kanji reading could not be saved. Please, try again.'));
        }
        $this->set(compact('kanjiReading'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Kanji Reading id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $kanjiReading = $this->KanjiReadings->get($id);
        if ($this->KanjiReadings->delete($kanjiReading)) {
            $this->Flash->success(__('The kanji reading has been deleted.'));
        } else {
            $this->Flash->error(__('The kanji reading could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
