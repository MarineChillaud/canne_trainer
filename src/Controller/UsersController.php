<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\EventInterface;
use App\Model\Table\UsersTable;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['login', 'register', 'recover']);
    }

    public function register()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success('Votre compte a été créé avec succès.', ['class' => 'flash-message success']);
                return $this->redirect(['action' => 'login']); // Redirige vers la page de connexion après l'inscription.
            }
            $this->Flash->error('Impossible de créer votre compte. Veuillez réessayer.', ['class' => 'flash-message error']);
        }
        $this->set(compact('user'));
    }

    public function login()
    {
        $result = $this->Authentication->getResult();
        // if user is logged, send him elsewhere
        if ($result->isValid()) {
            // récupère le userId et le stocke dans la session
            $this->request->getSession()->write('user.id', $result->getData('id'));

            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Events',
                'action' => 'index',
            ]);
            return $this->redirect($redirect);
        }
        if ($this->request->is('post')) {
            $this->Flash->error('Identifiant ou mot de passe invalide', ['class' => 'flash-message error']);
        }
    }

    public function logout()
    {
        $this->Authentication->logout();
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }

    public function recover()
    {
        if ($this->request->is('post')) {
            $formData = $this->request->getData();
            $user = $this->Users->findByUsername($formData['username'])->first();

            if ($user) {
                // génère un nouveau MdP
                $newPassword = $this->Users->generateRandomPassword();

                // Met à jour le MdP du user dans la bdd
                $user->password = $newPassword;
                $this->Users->save($user);

                // Envoi le nouveau password par mail au user
                $this->ssers->sendPasswordEmail($user->email, $newPassword);

                $this->Flash->success('Un nouveau mot de passe a été envoyé à votre adresse e-mail si celle-ci existe bien.' . $newPassword, ['class' => 'flash-message success']);
                return $this->redirect(['controller' => 'Users', 'action' => 'login']);
            } else {
                $this->Flash->error('Une erreur est survenue lors de la récupération du mot de passe. Veuillez réessayer ultérieurement.', ['class' => 'flash-message error']);
            }
        }
    }

    public function update()
    {
        $user = $this->Users->get($this->Authentication->getIdentity()->get('id'));

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $this->Users->save($user);
            $this->Authentication->setIdentity($user);
            $this->Flash->success('Votre profil a été mis à jour.', ['class' => 'flash-message success']);
            return $this->redirect(['action' => 'profile']);
        }

        $this->set(compact('user'));
    }

    public function profile()
    {
        // Récupére les informations de l'utilisateur connecté
        $user = $this->Authentication->getIdentity();

        // Passe les données de l'utilisateur à la vue
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.', ['class' => 'flash-message success']));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.', ['class' => 'flash-message error']));
        }

        return $this->redirect(['action' => 'index']);
    }
}
