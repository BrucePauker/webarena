<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Fighters Controller
 *
 * @property \App\Model\Table\FightersTable $Fighters
 *
 * @method \App\Model\Entity\Fighter[] paginate($object = null, array $settings = [])
 */
class FightersController extends AppController
{
    /**
     * View method
     *
     * @param string|null $id Fighter id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        // If it's the authenticated user's fighter
        if($id == null)
        {
            $fighters = $this->Fighters->find('all', ['player_id' => $this->Auth->user('id')])->contain(['Players', 'Guilds', 'Messages', 'Tools'])->toArray();
        }
        else
            $fighters = $this->Fighters->get($id, [
                'contain' => ['Players', 'Guilds', 'Messages', 'Tools']
            ]);

        $this->set('fighters', $fighters);
        $this->set('_serialize', ['fighters']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $fighter = $this->Fighters->newEntity();
        if ($this->request->is('post')) {
            $fighter = $this->Fighters->patchEntity($fighter, $this->request->getData());
            $fighter->current_health = 10;
            $fighter->level = 1;
            $fighter->xp = 1;
            $fighter->skill_strength = 5;
            $fighter->skill_health = 10;
            $fighter->skill_sight = 2;
            $fighter->player_id = $this->Auth->user('id');
            if ($this->Fighters->save($fighter)) {
                $this->Flash->success(__('The fighter has been saved.'));

                return $this->redirect(['action' => 'view'/ + $fighter->id]);
            }
            $this->Flash->error(__('The fighter could not be saved. Please, try again.'));
        }
        $players = $this->Fighters->Players->find('list', ['limit' => 200]);
        $guilds = $this->Fighters->Guilds->find('list', ['limit' => 200]);
        $this->set(compact('fighter', 'players', 'guilds'));
        $this->set('_serialize', ['fighter']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Fighter id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $fighter = $this->Fighters->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fighter = $this->Fighters->patchEntity($fighter, $this->request->getData());
            if ($this->Fighters->save($fighter)) {
                $this->Flash->success(__('The fighter has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fighter could not be saved. Please, try again.'));
        }
        $players = $this->Fighters->Players->find('list', ['limit' => 200]);
        $guilds = $this->Fighters->Guilds->find('list', ['limit' => 200]);
        $this->set(compact('fighter', 'players', 'guilds'));
        $this->set('_serialize', ['fighter']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Fighter id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $fighter = $this->Fighters->get($id);
        if ($this->Fighters->delete($fighter)) {
            $this->Flash->success(__('The fighter has been deleted.'));
        } else {
            $this->Flash->error(__('The fighter could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
