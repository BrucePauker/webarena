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
        $fighter = $this->loadModel()->Fighter;
        $size_x = $fighter->getSizeX();
        $size_y = $fighter->getSizeY();
        $this->set('size_x', $size_x);
        $this->set('size_y', $size_y);
    }

    
}
