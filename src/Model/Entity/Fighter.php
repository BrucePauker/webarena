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
    ];

    /**
     * Return the distance between an item and a fighter
     * Calculated by Manhattan distance
     *
     * @param $xA integer position x of the fighter
     * @param $xB integer position x of the object
     * @param $yA integer position y of the fighter
     * @param $yB integer position y of the object
     * @return integer distance between object
     */
    public function distance($xA, $xB, $yA, $yB)
    {
        $distance = abs($xB - $xA) + abs($yB - $yA);

        return $distance;
    }

    /**
     * Tell if the item is on sight
     *
     * @param $fighter \App\Model\Entity\Fighter
     * @param $xB integer
     * @param $yB integer
     * @return boolean
     */
    public function isOnSight($fighter, $xB, $yB) {
        if($fighter->skill_sight >= $this->distance($fighter->coordinate_x, $xB, $fighter->coordinate_y, $yB))
            return true;

        return false;
    }
}
