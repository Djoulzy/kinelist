<?php

namespace App\Form\DataTransformer;

use App\Service\SharedData;
use Symfony\Component\Form\DataTransformerInterface;

class SourceTransformer implements DataTransformerInterface
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
        $source_list = SharedData::getAppNames();
        foreach($source_list as $label => $id) {
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