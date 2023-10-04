<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * CanneTvApi Controller
 *
 * @method \App\Model\Entity\CanneTvApi[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CanneTvApiController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $canneTvApi = $this->paginate($this->CanneTvApi);

        $this->set(compact('canneTvApi'));
    }

    /**
     * View method
     *
     * @param string|null $id Canne Tv Api id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $canneTvApi = $this->CanneTvApi->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('canneTvApi'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $canneTvApi = $this->CanneTvApi->newEmptyEntity();
        if ($this->request->is('post')) {
            $canneTvApi = $this->CanneTvApi->patchEntity($canneTvApi, $this->request->getData());
            if ($this->CanneTvApi->save($canneTvApi)) {
                $this->Flash->success(__('The canne tv api has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The canne tv api could not be saved. Please, try again.'));
        }
        $this->set(compact('canneTvApi'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Canne Tv Api id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $canneTvApi = $this->CanneTvApi->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $canneTvApi = $this->CanneTvApi->patchEntity($canneTvApi, $this->request->getData());
            if ($this->CanneTvApi->save($canneTvApi)) {
                $this->Flash->success(__('The canne tv api has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The canne tv api could not be saved. Please, try again.'));
        }
        $this->set(compact('canneTvApi'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Canne Tv Api id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $canneTvApi = $this->CanneTvApi->get($id);
        if ($this->CanneTvApi->delete($canneTvApi)) {
            $this->Flash->success(__('The canne tv api has been deleted.'));
        } else {
            $this->Flash->error(__('The canne tv api could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
