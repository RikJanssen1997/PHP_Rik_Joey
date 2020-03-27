<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeadlineManagerController extends Controller
{
    public function sortArray(){
        usort($array, 'comparatorModule');
        //https://www.geeksforgeeks.org/sort-array-of-objects-by-object-fields-in-php/
    }

    function comparatorModule($object1, $object2){
        return $object1->Module > $object2->Module;
    }
}
