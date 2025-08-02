<?php

namespace App\Support;

class Container {
    private array $instances = [];
    private array $recipes = [];

    public function bind($value, \Closure $recipe) {
        $this->recipes[$value] = $recipe;
    }

    public function get($value) {
        if(empty($this->instances[$value])) {
            if(empty($this->recipes[$value])) {
                echo 'Could not build ' . $value . '<br>';
                die();
            }
            $this->instances[$value] = $this->recipes[$value]();
        }
        return $this->instances[$value];
    }
}