<?php
namespace App\Traits;

trait Helper
{
    public function parseAssociated($assocArray)
    {
        $newarr = [];
        foreach($assocArray as  $association) {
            $newarr[] = $association->value;
        }

        return $newarr;
    }
}
