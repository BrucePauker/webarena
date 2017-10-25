<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Controller\EventsController;
use App\Model\Entity\Arena;
/**
 * Arenas Controller
 *
 *
 */
class ArenasController extends AppController
{

    /**
     * @var instance of Fighter Controller
     */
    protected $fightersModel;

    /**
     * @var instance of Event Controller
     */
    protected $eventsController;

    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->fightersModel = $this->loadModel('Fighters');
        $this->eventsController = new EventsController();
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $fighterTable = $this->loadModel('Fighters');
        
        // Load the size of the grid
        $size_x = $fighterTable->getSizeX();
        $size_y = $fighterTable->getSizeY();

        //load the fighter of the current player
        $fighters = $fighterTable->loadAllFighters();
        
        $this->set('size_x', $size_x);
        $this->set('size_y', $size_y);
        $this->set('fighters', $fighters);
    }

    /**
     * Make an action on the fighter
     *
     * @param string action
     */
    public function makeAction($action) {
        $fighter = $this->loadModel('Fighters')->getCurrentFighter($this->Auth->user('id'));

        if($action == 'up')
        {
            if($this->fightersModel->isPositionFree($fighter->coordinate_x, $fighter->coordinate_y - 1))
            {
                $fighter->coordinate_y = $fighter->coordinate_y - 1;
                if($this->Fighters->save($fighter)) {
                    $this->Flash->success(__('You have moved.'));
                    $this->eventsController->add($fighter->name.' moved up!', $fighter->coordinate_x, $fighter->coordinate_y - 1);
                }
            }
            else
                $this->Flash->error(__('You try to move on an impossible part of the arena.'));
        }
        else if($action == 'down')
        {
            if($this->fightersModel->isPositionFree($fighter->coordinate_x, $fighter->coordinate_y + 1))
            {
                $fighter->coordinate_y = $fighter->coordinate_y + 1;
                if($this->Fighters->save($fighter)) {
                    $this->Flash->success(__('You have moved.'));
                    $this->eventsController->add($fighter->name.' moved up!', $fighter->coordinate_x, $fighter->coordinate_y + 1);
                }
            }
            else
                $this->Flash->error(__('You try to move on an impossible part of the arena.'));
        }
        else if($action == 'left')
        {
            if($this->fightersModel->isPositionFree($fighter->coordinate_x - 1, $fighter->coordinate_y))
            {
                $fighter->coordinate_x = $fighter->coordinate_x - 1;
                if($this->Fighters->save($fighter)) {
                    $this->Flash->success(__('You have moved.'));
                    $this->eventsController->add($fighter->name.' moved up!', $fighter->coordinate_x - 1, $fighter->coordinate_y);
                }
            }
            else
                $this->Flash->error(__('You try to move on an impossible part of the arena.'));
        }
        else if($action == 'right')
        {
            if($this->fightersModel->isPositionFree($fighter->coordinate_x + 1, $fighter->coordinate_y))
            {
                $fighter->coordinate_x = $fighter->coordinate_x + 1;
                if($this->Fighters->save($fighter)) {
                    $this->Flash->success(__('You have moved.'));
                    $this->eventsController->add($fighter->name.' moved up!', $fighter->coordinate_x + 1, $fighter->coordinate_y);
                }
            }
            else
                $this->Flash->error(__('You try to move on an impossible part of the arena.'));
        }

        $this->redirect(['action' => 'index']);
    }
}
