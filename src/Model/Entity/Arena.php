<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Surrounding Entity
 *
 * @property int $size_x
 * @property int $size_y
 */
class Arena extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '$size_x' => false,
        '$size_y' => false
    ];

    /**
     * Get the size X of the arena
     *
     * @return int
     */
    public function _getSizeX()
    {
        return $this->size_x = 15;
    }

    /**
     * Get the size Y of the arena
     *
     * @return int
     */
    public function _getSizeY()
    {
        return $this->size_y = 10;
    }
}