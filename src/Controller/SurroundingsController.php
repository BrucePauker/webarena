<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Surroundings Controller
 *
 * @property \App\Model\Table\SurroundingsTable $Surroundings
 *
 * @method \App\Model\Entity\Surrounding[] paginate($object = null, array $settings = [])
 */
class SurroundingsController extends AppController
{

    /**
     * Generate tools to be displayed on the arena
     * If there is already ten tools created in the database it won't create more
     *
     * @return void
     */
    public function generate() {

        if($this->Surroundings->find('all')->count() < 10)
        {
            for ($i = $this->Surroundings->find('all')->count(); $i < 10; $i++)
            {
                $surrounding = $this->Surroundings->newEntity();

                do {
                    $x = rand(0, 14);
                    $y = rand(0, 9);
                }while(!$this->isPositionFree($x, $y));

                $surrounding->coordinate_y = $y;
                $surrounding->coordinate_x = $x;

                $types = ['P', 'T', 'W'];

                $surrounding->type = $types[array_rand($types)];

                $this->Surroundings->save($surrounding);
            }
        }
        else
            $this->Flash->error(__('There is already 10 tools on the game.'));

        $this->redirect(['controller' => 'Arenas', 'action' => 'index']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Surrounding id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $surrounding = $this->Surroundings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $surrounding = $this->Surroundings->patchEntity($surrounding, $this->request->getData());
            if ($this->Surroundings->save($surrounding)) {
                $this->Flash->success(__('The surrounding has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The surrounding could not be saved. Please, try again.'));
        }
        $this->set(compact('surrounding'));
        $this->set('_serialize', ['surrounding']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Surrounding id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $surrounding = $this->Surroundings->get($id);
        if ($this->Surroundings->delete($surrounding)) {
            $this->Flash->success(__('The surrounding has been deleted.'));
        } else {
            $this->Flash->error(__('The surrounding could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
