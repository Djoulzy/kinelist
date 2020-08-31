<?php

namespace App\Form\DataTransformer;

use App\Service\Import\ImportCommon;
use Symfony\Component\Form\DataTransformerInterface;

class AreaTransformer implements DataTransformerInterface
{

    public function __construct()
    {   
    }

    /**
     * @param int|null $value
     * @return array
     */
    public function transform($value)
    {
        $tmp = array();
        $area_list = ImportCommon::getAreaNames();
        foreach($area_list as $label => $id) {
            if ($id & $value) $tmp[] = $id;
        }

        dump($tmp);
        return $tmp;
    }

    /**
     * @param  array $value
     * @return int
     */
    public function reverseTransform($value)
    {
        $tmp = 0;
        foreach($value as $id) $tmp |= $id;
        return $tmp;
    }
} 