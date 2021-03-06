<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Players Controller
 *
 * @property \App\Model\Table\PlayersTable $Players
 *
 * @method \App\Model\Entity\Player[] paginate($object = null, array $settings = [])
 */
class PlayersController extends AppController
{

    /**
     * Filter the event before the request happenes
     *
     * @param Event $event
     */
    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['add', 'login', 'forgotPassword', 'resetPassword']);
    }

    /**
     * View method
     *
     * @param string|null $id Player id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id)
    {
        if($this->Auth->user('id') == $id)
        {
            $player = $this->Players->get($id, [
                'contain' => ['Fighters']
            ]);

            $this->set('player', $player);
            $this->set('_serialize', ['player']);
        }
        else
        {
            $this->Flash->error(__('Access not allowed'));
            $this->redirect([
                'controller' => 'Players',
                'action' => 'view/'.$this->Auth->user('id'),
            ]);
        }
    }

    /**
     * Login function
     *
     * @return \Cake\Http\Response|null
     */
    public function login()
    {
        if ($this->request->is('post')) {
            $player = $this->Auth->identify();
            if ($player) {
                $this->Auth->setUser($player);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid email or password'));
        }
    }

    /**
     * Logout function
     *
     * @return \Cake\Http\Response|null
     */
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    /**
     * Add a new user method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $player = $this->Players->newEntity();
        if ($this->request->is('post')) {
            $player = $this->Players->patchEntity($player, $this->request->getData());
            if ($this->Players->save($player)) {
                $this->Flash->success(__("The player have been saved"));
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__("Impossible to add the player"));
        }
        $this->set('player', $player);
    }

    /**
     * Edit method
     *
     * @param string|null $id Player id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $player = $this->Players->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['put', 'post'])) {
            $player = $this->Players->patchEntity($player, $this->request->getData());
            if ($this->Players->save($player)) {
                $this->Flash->success(__('Your password has been successfully updated.'));
            }
            $this->Flash->error(__('Your password could not be saved. Please, try again.'));
        }

        $this->set(compact('player'));
        $this->set('_serialize', ['player']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Player id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $player = $this->Players->get($id);
        if ($this->Players->delete($player)) {
            $this->Flash->success(__('The player has been deleted.'));
        } else {
            $this->Flash->error(__('The player could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Show the view if the user wants to fin his password.
     * If post mode, find the user with his email and send the password data to
     * the getFotgottenPassword function
     *
     * @return \Cake\Http\Response
     */
    public function forgotPassword() {

        if ($this->request->is(['post'])) {
            $email = $this->request->getData()['email'];

            $player = $this->Players->find('all')->where(['email' => $email])->first();

            if($player == null)
                $this->Flash->error(__('No players with this email could be found.'));
            else
                $this->redirect(['action' => 'resetPassword/'.$player->id]);

        }
    }

    /**
     * Show the password of a user after he resuested
     *
     * @param integer $playerId
     * @erturn \Cake\Http\Response
     */
    public function resetPassword($playerId) {
        $player = $this->Players->get($playerId);

        if ($this->request->is('post')) {
            $player = $this->Players->patchEntity($player, $this->request->getData());
            if ($this->Players->save($player)) {
                $this->Flash->success(__("The player have been saved"));
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__("Impossible to save the player"));
        }

        $this->set('player', $player);
    }
}
