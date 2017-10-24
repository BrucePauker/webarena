<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\Arena;
/**
 * Arenas Controller
 *
 *
 */
class ArenasController extends AppController
{

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
}
