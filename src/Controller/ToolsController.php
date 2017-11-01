<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Tools Controller
 *
 * @property \App\Model\Table\ToolsTable $Tools
 *
 * @method \App\Model\Entity\Tool[] paginate($object = null, array $settings = [])
 */
class ToolsController extends AppController
{

    /**
     * Generate tools to be displayed on the arena
     * If there is already ten tools created in the database it won't create more
     *
     * @return void
     */
    public function generate() {

        if($this->Tools->find('all')->count() < 10)
        {
            for ($i = $this->Tools->find('all')->count(); $i < 10; $i++)
            {
                $tool = $this->Tools->newEntity();

                do {
                    $x = rand(0, 14);
                    $y = rand(0, 9);
                }while(!$this->isPositionFree($x, $y));

                $tool->coordinate_y = $y;
                $tool->coordinate_x = $x;

                $tool->type = rand(0, 2);
                $tool->bonus = rand(1, 4);

                $this->Tools->save($tool);
            }
        }
        else
            $this->Flash->error(__('There is already 10 tools on the game.'));

        $this->redirect(['controller' => 'Arenas', 'action' => 'index']);
    }

    /**
     * Check if a position on the map is free for a tool
     *
     * @param $x integer
     * @param $y integer
     * @return boolean
     */
    public function isPositionFree($x, $y)
    {
        if($x > $this->loadModel('Fighters')->getSizeX() - 1 || $x < 0)
            return false;
        if($y < 0 || $y > $this->loadModel('Fighters')->getSizeY() - 1)
            return false;

        $tools = $this->Tools->find('all')->toArray();

        foreach ($tools as $tool)
        {
            if($tool->coordinate_x == $x && $tool->coordinate_y == $y && $tool->fighter_id == null)
                return false;
        }

        return true;
    }
}
