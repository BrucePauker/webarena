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
     * @var FightersController
     */
    protected $fightersModel;

    /**
     * @var EventsController
     */
    protected $eventsController;

    /**
     * Initialize the controller with by calling first the initialize method of App Contorller
     *
     * @return void
     */
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
        // Load the size of the grid
        $size_x = $this->fightersModel->getSizeX();
        $size_y = $this->fightersModel->getSizeY();

        $fighter = $this->fightersModel->getCurrentFighter();

        if($fighter && !$this->loadModel('Fighters')->exists(['id' => $fighter->id]))
        {
            unset($_SESSION['fighter']);
            $fighter = null;
        }

        if($fighter)
        {
            if(round($fighter->xp/4, 0, PHP_ROUND_HALF_DOWN) > $fighter->level)
                $this->Flash->success(__('You upgraded your level, go edit your fighter.'));

            $fighters = $this->fightersModel->loadAllFightersOnSight($fighter);
            $tools = $this->loadModel('Tools')->getToolsOnSight($fighter);

        }
        else
        {
            $fighters = null;
            $tools = null;
            $this->Flash->error(__('You don\'t have a current fighter.'));
        }
        
        $this->set('size_x', $size_x);
        $this->set('size_y', $size_y);
        $this->set('fighters', $fighters);
        $this->set('fighter', $fighter);
        $this->set('tools', $tools);
    }

    /**
     * Make an action on the fighter
     *
     * @param string action
     */
    public function makeAction($action) {
        $fighter = $this->loadModel('Fighters')->getCurrentFighter();

        if(!$fighter)
        {
            $this->Flash->error(__('You don\'t have a current fighter.'));
            $this->redirect(['action' => 'index']);
            return;
        }

        $newPosX = 0;
        $newPosY = 0;

        if($action == 'up')
        {
            $newPosX = $fighter->coordinate_x;
            $newPosY = $fighter->coordinate_y - 1;
        }
        else if($action == 'down')
        {
            $newPosX = $fighter->coordinate_x;
            $newPosY = $fighter->coordinate_y + 1;
        }
        else if($action == 'left')
        {
            $newPosX = $fighter->coordinate_x - 1;
            $newPosY = $fighter->coordinate_y;
        }
        else if($action == 'right')
        {
            $newPosX = $fighter->coordinate_x + 1;
            $newPosY = $fighter->coordinate_y;
        }

        // Make the test on the new position
        $isFree = $this->getObjectAtPos($newPosX, $newPosY);
        if($isFree)
        {
            if($isFree == 'available')
            {
                $fighter->coordinate_x = $newPosX;
                $fighter->coordinate_y = $newPosY;

                if($this->Fighters->save($fighter)) {
                    $this->Flash->success(__('You have moved.'));
                    $this->eventsController->add($fighter->name.' moved!', $fighter->coordinate_x, $fighter->coordinate_y );
                }
            }
            else if($isFree[0] == 'fighter')
            {
                if($fighter->player_id == $isFree[1]->player_id)
                {
                    $this->Flash->error(__('You try to attack your own fighter.'));
                    $this->redirect(['action' => 'index']);
                }
                else
                {
                    $succeed = $this->fightersModel->attack($fighter, $isFree[1]);
                    if($succeed == 'miss')
                        $this->Flash->error(__('You\'re attack didn\'t work.'));
                    else if($succeed == 'touched')
                    {
                        $this->Flash->success(__('You touched your opponent.'));
                        $this->eventsController->add($fighter->name.' moved.', $fighter->coordinate_x, $fighter->coordinate_y);
                    }
                    else if($succeed == 'killed')
                    {
                        $fighter->coordinate_x = $newPosX;
                        $fighter->coordinate_y = $newPosY;
                        $this->Fighters->save($fighter);

                        foreach ($isFree[1]->tools as $tool)
                            $this->loadModel('Tools')->delete($tool);

                        $this->eventsController->add($fighter->name.' killed '.$isFree[1]->name.'!', $fighter->coordinate_x, $fighter->coordinate_y);
                        $this->Flash->success(__('You killed your opponent.'));
                    }
                }
            }
            else if($isFree[0] == 'tools')
            {
                $fighter->coordinate_x = $newPosX;
                $fighter->coordinate_y = $newPosY;

                $tool = $isFree[1];
                $tool->fighter_id = $fighter->id;
                $this->loadModel('Tools')->save($isFree[1]);

                if($tool->type == '0')
                {
                    $fighter->skill_sight = $fighter->skill_sight + $tool->bonus;
                    $this->Flash->success(__('You upgraded your sight from '.$tool->bonus));
                }
                else if($tool->type == '1')
                {
                    $fighter->skill_strength = $fighter->skill_strength + $tool->bonus;
                    $this->Flash->success(__('You upgraded your strength from '.$tool->bonus));
                }
                else if($tool->type == '2')
                {
                    $fighter->skill_health = $fighter->skill_health + $tool->bonus;
                    $fighter->current_health = $fighter->skill_health;
                    $this->Flash->success(__('You upgraded your health from '.$tool->bonus));
                }

                $this->Fighters->save($fighter);
            }
        }
        else
            $this->Flash->error(__('You try to move on an impossible part of the arena.'));

        $this->redirect(['action' => 'index']);
    }

    /**
     * Get the object if any at a certain position
     *
     * @param integer $x
     * @param integer $y
     */
    public function getObjectAtPos($x, $y)
    {
        $fighter = $this->loadModel('Fighters')->isPositionFree($x, $y);

        if($fighter[0] == 'fighter')
            return $fighter;

        $tool = $this->loadModel('Tools')->isToolsAtPos($x, $y);

        if($tool)
            return ['tools', $tool];

        return 'available';
    }
}
