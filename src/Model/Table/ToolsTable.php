<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tools Model
 *
 * @property \App\Model\Table\FightersTable|\Cake\ORM\Association\BelongsTo $Fighters
 *
 * @method \App\Model\Entity\Tool get($primaryKey, $options = [])
 * @method \App\Model\Entity\Tool newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Tool[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tool|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tool patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Tool[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tool findOrCreate($search, callable $callback = null, $options = [])
 */
class ToolsTable extends Table
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

        $this->setTable('tools');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Fighters', [
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
            ->scalar('type')
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        $validator
            ->integer('bonus')
            ->requirePresence('bonus', 'create')
            ->notEmpty('bonus');

        $validator
            ->integer('coordinate_x')
            ->allowEmpty('coordinate_x');

        $validator
            ->integer('coordinate_y')
            ->allowEmpty('coordinate_y');

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
        $rules->add($rules->existsIn(['fighter_id'], 'Fighters'));

        return $rules;
    }

    /**
     * Load the all the tools on sight of the database
     *
     * @param Cake\ORM\Entity\Fighter
     * @return Array Cake\ORM\Entity\Fighter
     */
    public function getToolsOnSight($fighter) {
        $tools = $this->find('all')->toArray();

        foreach ($tools as $key => $tool) {
            if(!$this->isOnSight($fighter, $tool->coordinate_x, $tool->coordinate_y))
                unset($tools[$key]);
        }

        return $tools;
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

    /**
     * Check if a position on the map is free for a tool
     *
     * @param $x integer
     * @param $y integer
     * @return boolean
     */
    public function isToolsAtPos($x, $y)
    {
        $tools = $this->find('all')->toArray();

        foreach ($tools as $tool)
        {
            if($tool->coordinate_x == $x && $tool->coordinate_y == $y)
                return $tool;
        }

        return false;
    }
}
