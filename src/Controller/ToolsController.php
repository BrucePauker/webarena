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

    public function generate() {

        if($this->Tools->find('all')->count() < 10)
        {
            for ($i = 0; $i < 10; $i++)
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
     * Edit method
     *
     * @param string|null $id Tool id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tool = $this->Tools->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tool = $this->Tools->patchEntity($tool, $this->request->getData());
            if ($this->Tools->save($tool)) {
                $this->Flash->success(__('The tool has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tool could not be saved. Please, try again.'));
        }
        $fighters = $this->Tools->Fighters->find('list', ['limit' => 200]);
        $this->set(compact('tool', 'fighters'));
        $this->set('_serialize', ['tool']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Tool id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tool = $this->Tools->get($id);
        if ($this->Tools->delete($tool)) {
            $this->Flash->success(__('The tool has been deleted.'));
        } else {
            $this->Flash->error(__('The tool could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
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
            if($tool->coordinate_x == $x && $tool->coordinate_y == $y)
                return true;
        }

        return 'available';
    }
}
