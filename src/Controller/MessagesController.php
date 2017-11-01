<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;

/**
 * Messages Controller
 *
 * @property \App\Model\Table\MessagesTable $Messages
 *
 * @method \App\Model\Entity\Message[] paginate($object = null, array $settings = [])
 */
class MessagesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        if($this->loadModel('Fighters')->getCurrentFighter() != null)
        {
            $fighter = $this->loadModel('Fighters')->getCurrentFighter();
            $messagesFrom = $this->Messages->find('all')->contain(['FightersFrom'])->where(['fighter_id' => $fighter->id])->toArray();
            $messagesTo = $this->Messages->find('all')->contain(['FightersTo'])->where(['fighter_id_from' => $fighter->id])->toArray();
        }
        else
        {
            $fighter = null;
            $messagesFrom = null;
            $messagesTo = null;
        }

        $this->set(compact('messagesFrom', 'messagesTo', 'fighter'));
        $this->set('_serialize', ['messages']);
    }

    /**
     * View method
     *
     * @param string|null $id Message id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $message = $this->Messages->get($id, [
            'contain' => ['Fighters']
        ]);

        $this->set('message', $message);
        $this->set('_serialize', ['message']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $message = $this->Messages->newEntity();

        if ($this->request->is('post') && $this->loadModel('Fighters')->getCurrentFighter()) {
            $message = $this->Messages->patchEntity($message, $this->request->getData());
            $message->fighter_id_from = $this->loadModel('Fighters')->getCurrentFighter()->id;
            $message->date = Time::now();
            if ($this->Messages->save($message)) {
                $this->Flash->success(__('The message has been send.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The message could not be saved. Please, try again.'));
        }
        else if(!$this->loadModel('Fighters')->getCurrentFighter())
            $this->Flash->error(__('You don\'t have a current fighter.'));

        $fighters = $this->Messages->FightersTo->find('list', ['limit' => 200]);

        $this->set(compact('message', 'fighters'));
        $this->set('_serialize', ['message']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Message id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $message = $this->Messages->get($id);
        if ($this->Messages->delete($message)) {
            $this->Flash->success(__('The message has been deleted.'));
        } else {
            $this->Flash->error(__('The message could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
