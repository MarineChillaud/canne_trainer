<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Client;
use Cake\Http\Client\JsonParser;

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
        $client = new Client();
        $url = 'https://canne.tv/replay/';

        try {
            $response = $client->get($url);

            if ($response->getStatusCode() === 200) {
                $jsonData = $response->getJson();

                $tournaments = [];

                foreach ($jsonData as $tournamentData) {
                    $tournamentName = $tournamentData['link'];
                    $tournamentDate = $tournamentData['date'];

                    $tournaments[] = [
                        'Link' => $tournamentName,
                        'date' => $tournamentDate,
                    ];
                }
                $this->set(compact('tournaments'));
                $this->viewBuilder()->setTemplate('Videos/index');
            } else {
                $this->Flash->error('Impossible de récupérer les données depuis l\'API CanneTV.', ['class' => 'flash-message error']);
            }
        } catch (\Exception $e) {
            $this->Flash->error('Une erreur s\'est produite lors de la récupération des données depuis l\'API CanneTV.', ['class' => 'flash-message error']);
        }
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

    public function getVideoDetails($videoId)
    {
        // Effectue la requête HTTP vers l'API CanneTV pour récupérer les détails de la vidéo
        $url = "https://canne.tv/replay/link_provider.php?id=" . $videoId;
        $response = file_get_contents($url);

        // Traite la réponse JSON et renvoie les données à la vue
        $data = json_decode($response, true);

        $this->set(compact('data'));
        $this->set('_serialize', ['data']); // Permet de sérialiser les données en JSON

    }

    public function getEncounterDetails($videoId)
    {
        // Effectue la requête HTTP vers l'API CanneTV pour récupérer les détails de la rencontre
        $url = "https://canne.tv/replay/encounter_details.php?id=" . $videoId;
        $response = file_get_contents($url);

        // Traite la réponse JSON et renvoie les données à la vue
        $data = json_decode($response, true);

        $this->set(compact('data'));
        $this->set('_serialize', ['data']); // Permet de sérialiser les données en JSON

    }
}
