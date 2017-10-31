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
