<?php
namespace App\Controller;

// use App\Controller\AppController;


/**
 * KanjiReadings Controller
 *
 * @property \App\Model\Table\KanjiReadingsTable $KanjiReadings
 *
 * @method \App\Model\Entity\KanjiReading[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class KanjiReadingsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $conditions = [];

        foreach ($this->request->getQuery() as $column => $value) {
            if (in_array($column, $this->{$this->name}->getSchema()->columns())) {
                if ($this->{$this->name}->getSchema()->typeMap()[$column] === 'string') {
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

            $value->label = $value->reading;
        }

        $this->disableAutoRender();
        $this->response = $this->response->withType('application/json');
        echo json_encode(${lcfirst($this->name)});
        return;
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
