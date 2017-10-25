<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Fighters Model
 *
 * @property \App\Model\Table\PlayersTable|\Cake\ORM\Association\BelongsTo $Players
 * @property \App\Model\Table\GuildsTable|\Cake\ORM\Association\BelongsTo $Guilds
 * @property \App\Model\Table\MessagesTable|\Cake\ORM\Association\HasMany $Messages
 * @property \App\Model\Table\ToolsTable|\Cake\ORM\Association\HasMany $Tools
 *
 * @method \App\Model\Entity\Fighter get($primaryKey, $options = [])
 * @method \App\Model\Entity\Fighter newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Fighter[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Fighter|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Fighter patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Fighter[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Fighter findOrCreate($search, callable $callback = null, $options = [])
 */
class FightersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('fighters');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Players', [
            'foreignKey' => 'player_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Guilds', [
            'foreignKey' => 'guild_id'
        ]);
        $this->hasMany('Messages', [
            'foreignKey' => 'fighter_id'
        ]);
        $this->hasMany('Tools', [
            'foreignKey' => 'fighter_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('player_id')
            ->requirePresence('player_id', 'create')
            ->notEmpty('player_id', 'It must be assign to a player');

        $validator
            ->scalar('name')
            ->requirePresence('name', 'create')
            ->notEmpty('name', 'There must be a name');

        $validator
            ->integer('coordinate_x')
            ->requirePresence('coordinate_x', 'create')
            ->notEmpty('coordinate_x');

        $validator
            ->integer('coordinate_y')
            ->requirePresence('coordinate_y', 'create')
            ->notEmpty('coordinate_y');

        $validator
            ->integer('level')
            ->requirePresence('level', 'create')
            ->allowEmpty('level', 'create');

        $validator
            ->integer('xp')
            ->requirePresence('xp', 'create')
            ->allowEmpty('xp', 'create');

        $validator
            ->integer('skill_sight')
            ->requirePresence('skill_sight', 'create')
            ->allowEmpty('skill_sight', 'create');

        $validator
            ->integer('skill_strength')
            ->requirePresence('skill_strength', 'create')
            ->allowEmpty('skill_strength', 'create');

        $validator
            ->integer('skill_health')
            ->requirePresence('skill_health', 'create')
            ->allowEmpty('skill_health', 'create');

        $validator
            ->integer('current_health')
            ->requirePresence('current_health', 'create')
            ->allowEmpty('current_health', 'create');

        $validator
            ->dateTime('next_action_time')
            ->allowEmpty('next_action_time', 'create');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['player_id'], 'Players'));
        $rules->add($rules->existsIn(['guild_id'], 'Guilds'));

        return $rules;
    }

    public function getSizeX(){
        return 15;
    }

    public function getSizeY(){
        return 10;
    }

    /**
     * Check if a position on the map is free
     *
     * @param $x integer
     * @param $y integer
     * @return boolean
     */
    public function isPositionFree($x, $y)
    {
        if($x > $this->getSizeX() || $x < 0)
            return false;
        if($y < 0 || $y > $this->getSizeY())
            return false;

        $fighters = $this->find('all')->toArray();

        foreach ($fighters as $fighter)
        {
            if($fighter->coordinate_x == $x && $fighter->coordinate_y == $y)
                return false;
        }

        return true;
    }

    public function getCurrentFighter($playerId) {
        $fighter = $this->find('all')->where(['player_id' => $playerId])->contain(['Players', 'Guilds', 'Messages', 'Tools'])->toArray();

        if(!$fighter)
            return null;

        return $fighter[0];
    }

    /**
    * Load the fighters of the connected player
    *
    * @param integer id of the player 
    * @return Array Cake\ORM\Entity\Fighter
    */
    public function loadFightersPlayer($playerId) {
        $fighters = $this->find('all')->where(['player_id' => $playerId])->contain(['Players', 'Guilds', 'Messages', 'Tools'])->toArray();

        return $fighters;
    }

    /**
    * Load the all the fighters of the database
    *
    * @return Array Cake\ORM\Entity\Fighter
    */
    public function loadAllFighters() {
        $fighters = $this->find('all')->contain(['Players', 'Guilds', 'Messages', 'Tools'])->toArray();

        return $fighters;
    }

    /**
     * Load the all the fighters of the database
     *
     * @param Cake\ORM\Entity\Fighter
     * @return Array Cake\ORM\Entity\Fighter
     */
    public function loadAllFightersOnSight($fighter) {
        $fighters = $this->loadAllFighters();

        foreach ($fighters as $key => $fighterItem) {
            if(!$this->isOnSight($fighter, $fighterItem->coordinate_x, $fighterItem->coordinate_y))
                unset($fighters[$key]);
        }

        return $fighters;
    }

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
     * @param $fighter $this
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
