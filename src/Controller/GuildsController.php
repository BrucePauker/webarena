<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Routing\Router;

/**
 * Guilds Controller
 *
 * @property \App\Model\Table\GuildsTable $Guilds
 *
 * @method \App\Model\Entity\Guild[] paginate($object = null, array $settings = [])
 */
class GuildsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $guilds = $this->Guilds->find('all')->contain(['Fighters']);

        $currentFighter = $this->loadModel('Fighters')->getCurrentFighter();

        $this->set(compact(['guilds', 'currentFighter', 'urlAddGuild']));
        $this->set('_serialize', ['guilds']);
    }

    /**
     * View method
     *
     * @param string|null $id Guild id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $guild = $this->Guilds->get($id, [
            'contain' => ['Fighters']
        ]);
        $currentFighter = $this->loadModel('Fighters')->getCurrentFighter();

        $this->set(compact(['guild', 'currentFighter']));
        $this->set('_serialize', ['guild']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        $guild = $this->Guilds->newEntity();
        if ($this->request->is('post')) {
            $guild = $this->Guilds->patchEntity($guild, $this->request->getData());
            if ($this->Guilds->save($guild)) {
                $this->Flash->success(__('The guild has been saved.'));
                return $this->redirect(['action' => 'view/'.$guild->id]);
            }
            $this->Flash->error(__('The guild could not be saved. Please, try again.'));
        }
        $this->set(compact('guild'));
        $this->set('_serialize', ['guild']);
    }


    /**
     * Join a guild with a specific fighter
     *
     * @param $idGuild intger
     * @param $idFighter integer
     */
    public function join($idGuild) {
        $fighter = $this->loadModel('Fighters')->getCurrentFighter();
        $this->loadModel('Fighters')->query()->update()->set(['guild_id' => $idGuild])->where(['id' => $fighter->id])->execute();

        return $this->redirect(['action' => 'view/'.$idGuild]);
    }

    /**
     * Leave a guild
     *
     * @return Action index
     */
    public function leave() {
        $fighter = $this->loadModel('Fighters')->getCurrentFighter();
        $this->loadModel('Fighters')->query()->update()->set(['guild_id' => null])->where(['id' => $fighter->id])->execute();

        return $this->redirect(['action' => 'index']);
    }
}
