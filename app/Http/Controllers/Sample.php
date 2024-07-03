<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ReflectionClass;
use ReflectionProperty;

class Sample extends Controller
{
    public $a = 1, $b = 2, $c;

    public function test(){

        /*
        $variable = ['a', 'b'=> 'bandar', 'c'=>['cat', 'camel']];
        cd($variable, 'animal_list');
        */

        //cl('temporary', 'World');

        // Get all public properties of this object
        $publicVars = get_object_vars($this);

        // Return only the public properties defined in this class
        $classVars = array_keys(get_class_vars(__CLASS__));

        $array_intersect_key =  array_intersect_key($publicVars, array_flip($classVars));

        cd($publicVars, '$publicVars');
        cd($classVars, '$classVars');
        cd($array_intersect_key, '$array_intersect_key');

        

        $publicProperties = get_public_vars($this);
        cd($publicProperties);
    }
}
