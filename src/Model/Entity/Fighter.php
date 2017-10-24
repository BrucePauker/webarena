<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Fighter Entity
 *
 * @property int $id
 * @property string $name
 * @property string $player_id
 * @property int $coordinate_x
 * @property int $coordinate_y
 * @property int $level
 * @property int $xp
 * @property int $skill_sight
 * @property int $skill_strength
 * @property int $skill_health
 * @property int $current_health
 * @property \Cake\I18n\FrozenTime $next_action_time
 * @property int $guild_id
 *
 * @property \App\Model\Entity\Player $player
 * @property \App\Model\Entity\Guild $guild
 * @property \App\Model\Entity\Message[] $messages
 * @property \App\Model\Entity\Tool[] $tools
 */
class Fighter extends Entity
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
        'name' => true,
        'player_id' => true,
        'coordinate_x' => true,
        'coordinate_y' => true,
        'level' => true,
        'xp' => true,
        'skill_sight' => true,
        'skill_strength' => true,
        'skill_health' => true,
        'current_health' => true,
        'next_action_time' => true,
        'guild_id' => true,
        'player' => true,
        'guild' => true,
        'messages' => true,
        'tools' => true,
        'size_x' => false,
        'size_y'=> false
    ];

    function getSizeX(){
        return 15;
    }

    function getSizeY(){
        return 10;
    }

    /**
     * Check if a position on the map is free
     *
     * @param $x integer
     * @param $y intger
     * @return boolean
     */
    public function isPositionFree($x, $y)
    {
        if($x > $this->getSizeX() || $x < 0)
            return false;
        else if($y < 0 || $y > $this->getSizeY())
            return false;

        $fighters = $this->fighters->find('all')->toArray();

        foreach ($fighters as $fighter)
        {
            if($fighter->coordinate_x == $x || $fighter->coordinate_y == $y)
                return false;
        }

        return true;
    }
}
