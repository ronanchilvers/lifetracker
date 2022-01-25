<?php

namespace App\Model;

use Ronanchilvers\Orm\Orm;
use Ronanchilvers\Orm\Model;
use Respect\Validation\Validator;
use Ronanchilvers\Orm\Traits\HasValidationTrait;

/**
 * Model representing an NPC
 */
class Character extends Model
{
    use HasValidationTrait;

    static protected $columnPrefix = 'character';

    static protected $standardArray = [
        15, 
        14, 
        13, 
        12, 
        10, 
        8
    ];

    /** Validation */
    public function setupValidation()
    {
        $rules = [
            'name' => Validator::notEmpty(),
        ];
        foreach (['str', 'dex', 'con', 'int', 'wis', 'cha'] as $stat) {
            $rules[$stat] = Validator::notEmpty()->intVal()->min(1)->max(20);
        }
        $this->registerRules($rules, 'default');
    }

    /** Utility methods */

    /**
     * Assign the standard 5th edition array to this character
     *
     * @return void
     */
    public function assignStandardArray(): void
    {
        $array = static::$standardArray;
        shuffle($array);

        foreach (['str', 'dex', 'con', 'int', 'wis', 'cha'] as $attribute) {
            $this->$attribute = array_shift($array);
        }
    }

    /** Accessors and mutators */

    /**
     * Get the modifier for the strength attribute
     *
     * @return integer
     */
    public function strModifier(): int
    {
        return $this->calculateModifier($this->str);
    }

    /**
     * Get the modifier for the dexterity attribute
     *
     * @return integer
     */
    public function dexModifier(): int
    {
        return $this->calculateModifier($this->dex);
    }

    /**
     * Get the modifier for the constitution attribute
     *
     * @return integer
     */
    public function conModifier(): int
    {
        return $this->calculateModifier($this->con);
    }

    /**
     * Get the modifier for the intelligence attribute
     *
     * @return integer
     */
    public function intModifier(): int
    {
        return $this->calculateModifier($this->int);
    }

    /**
     * Get the modifier for the wisdom attribute
     *
     * @return integer
     */
    public function wisModifier(): int
    {
        return $this->calculateModifier($this->wis);
    }

    /**
     * Get the modifier for the charisma attribute
     *
     * @return integer
     */
    public function chaModifier(): int
    {
        return $this->calculateModifier($this->cha);
    }

    /**
     * Generic modifier calculation
     *
     * @param integer $value
     * @return integer
     */
    private function calculateModifier(int $value): int
    {
        if (empty($value)) {
            return 0;
        }

        return floor(($value - 10)/2);
    }
}
