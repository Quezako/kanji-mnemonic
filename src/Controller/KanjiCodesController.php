<?php
namespace App\Controller;

// use App\Controller\AppController;
use Rest\Controller\RestController;

/**
 * KanjiCodes Controller
 *
 * @property \App\Model\Table\KanjiCodesTable $KanjiCodes
 *
 * @method \App\Model\Entity\KanjiCode[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class KanjiCodesController extends RestController
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

            $value->label = $value->ids;
        }

        $this->set(compact(lcfirst($this->name)));
    }

    /**
     * View method
     *
     * @param string|null $id Kanji Code id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $kanjiCode = $this->KanjiCodes->get($id, [
            'contain' => []
        ]);

        $this->set('kanjiCode', $kanjiCode);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $kanjiCode = $this->KanjiCodes->newEntity();
        if ($this->request->is('post')) {
            $kanjiCode = $this->KanjiCodes->patchEntity($kanjiCode, $this->request->getData());
            if ($this->KanjiCodes->save($kanjiCode)) {
                $this->Flash->success(__('The kanji code has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The kanji code could not be saved. Please, try again.'));
        }
        $this->set(compact('kanjiCode'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Kanji Code id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $kanjiCode = $this->KanjiCodes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $kanjiCode = $this->KanjiCodes->patchEntity($kanjiCode, $this->request->getData());
            if ($this->KanjiCodes->save($kanjiCode)) {
                $this->Flash->success(__('The kanji code has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The kanji code could not be saved. Please, try again.'));
        }
        $this->set(compact('kanjiCode'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Kanji Code id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $kanjiCode = $this->KanjiCodes->get($id);
        if ($this->KanjiCodes->delete($kanjiCode)) {
            $this->Flash->success(__('The kanji code has been deleted.'));
        } else {
            $this->Flash->error(__('The kanji code could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
