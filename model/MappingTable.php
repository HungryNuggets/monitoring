<?php

/**
* This abstract class must be extended by all SQL table mapping classes
*/
abstract class MappingTable {

    // CONSTRUCTOR
    final public function __construct(array $datas) {
        $this->hydrate($datas);
    }

    // HYDRATE METHOD
    final protected function hydrate(array $datas) {
        // IF SETTER IN CHILD CLASS
        foreach ($datas as $key => $value) {
            $keyToArray = explode("_", $key);
            $methodSetters = "set";
            foreach ($keyToArray as $word) {
                $methodSetters .= ucfirst($word);
            }
            if (method_exists($this, $methodSetters)) {
                $this->$methodSetters($value);
            }
        }
    }

    public function __set($name, $value) {
        if (!property_exists($this, $name)) {
            $this->$name = $value;
        } else {
            trigger_error("You can't rewrite an existing protected or private attribute", E_USER_NOTICE);
        }
    }

    public function __get($name) {
        if (property_exists($this, $name)) {
            return $this->$name;
        } else {
            trigger_error("You can't read an existing protected or private attribute without going through his getter", E_USER_NOTICE);
        }
    }
}