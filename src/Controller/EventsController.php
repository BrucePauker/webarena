<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;

/**
 * Events Controller
 *
 * @property \App\Model\Table\EventsTable $Events
 *
 * @method \App\Model\Entity\Event[] paginate($object = null, array $settings = [])
 */
class EventsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $events = $this->getEventsOnSight();

        $this->set(compact('events'));
        $this->set('_serialize', ['events']);
    }

    /**
     * View method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $event = $this->Events->get($id, [
            'contain' => []
        ]);

        $this->set('event', $event);
        $this->set('_serialize', ['event']);
    }

    /**
     * Add method
     *
     * @param string $name of the event
     * @param integer coordinate_x default null
     * @param integer coordiante_y default null
     */
    public function add($name, $coordinate_x = null, $coordinate_y = null)
    {
        $event = $this->Events->newEntity();

        $event->name = $name;
        $event->date = Time::now();
        $event->coordinate_y = $coordinate_y;
        $event->coordinate_x = $coordinate_x;

        if ($this->Events->save($event)) {
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('The event could not be saved.'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $event = $this->Events->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $event = $this->Events->patchEntity($event, $this->request->getData());
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The event could not be saved. Please, try again.'));
        }
        $this->set(compact('event'));
        $this->set('_serialize', ['event']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $event = $this->Events->get($id);
        if ($this->Events->delete($event)) {
            $this->Flash->success(__('The event has been deleted.'));
        } else {
            $this->Flash->error(__('The event could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Return all the events on sight less than 24 hours ago
     *
     * @return array App\Model\Entity\Event
     */
    public function getEventsOnSight(){
        $eventsOnTime = $this->Events->getLastEvent();
        $fighters = $this->loadModel('Fighters')->loadFightersPlayer($this->Auth->user('id'));
        $events = Array();

        foreach ($eventsOnTime as $eventOnTime) {
            foreach ($fighters as $fighter) {
                if($this->loadModel('Fighters')->isOnSight($fighter, $eventOnTime->coordinate_x, $eventOnTime->coordinate_y)) {
                    array_push($events, $eventOnTime);
                    break;
                }
            }
        }

        return $events;
    }
}
