<?php
namespace App\Controller;

// use App\Controller\AppController;
use Rest\Controller\RestController;

/**
 * Chmn Controller
 *
 * @property \App\Model\Table\ChmnTable $Chmn
 *
 * @method \App\Model\Entity\Chmn[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
//class ChmnController extends AppController
class ChmnController extends RestController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		$hanzi = $this->request->query('hanzi');
		$meaning = $this->request->query('meaning');
		$kanji = $this->request->query('kanji');
		$latin = $this->request->query('latin');
		//Hanzi	Simplified	Mnemonics	Alike	Meaning	Reference

		$conditions = [];

		if (!empty($hanzi)) {
			$conditions[] = ['hanzi LIKE' => "%$hanzi%"];
		}

		if (!empty($meaning)) {
			$conditions[] = ['meaning LIKE' => "%$meaning%"];
		}

		if (!empty($kanji)) {
			$conditions[] = [
				'OR' => [
					'mnemonics LIKE' => "%$latin%",
					'meaning LIKE' => "%$latin%",
				]
			];
		}
		if (!empty($kanji)) {
			$conditions[] = [
				'OR' => [
					'hanzi LIKE' => "%$kanji%",
					'simplified LIKE' => "%$kanji%",
					'alike LIKE' => "%$kanji%",
					'reference LIKE' => "%$kanji%",
				]
			];
		}
		$chmn = $this->paginate('Chmn', [
			'conditions' => $conditions,
		]);

        $this->set(compact('chmn'));
    }

    /**
     * View method
     *
     * @param string|null $id Chmn id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $chmn = $this->Chmn->get($id, [
            'contain' => []
        ]);

        $this->set('chmn', $chmn);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $chmn = $this->Chmn->newEntity();
        if ($this->request->is('post')) {
            $chmn = $this->Chmn->patchEntity($chmn, $this->request->getData());
            if ($this->Chmn->save($chmn)) {
                $this->Flash->success(__('The chmn has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The chmn could not be saved. Please, try again.'));
        }
        $this->set(compact('chmn'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Chmn id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $chmn = $this->Chmn->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $chmn = $this->Chmn->patchEntity($chmn, $this->request->getData());
            if ($this->Chmn->save($chmn)) {
                $this->Flash->success(__('The chmn has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The chmn could not be saved. Please, try again.'));
        }
        $this->set(compact('chmn'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Chmn id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $chmn = $this->Chmn->get($id);
        if ($this->Chmn->delete($chmn)) {
            $this->Flash->success(__('The chmn has been deleted.'));
        } else {
            $this->Flash->error(__('The chmn could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
