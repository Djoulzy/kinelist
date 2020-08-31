<?php

namespace App\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

class CheckBoxTransformer implements DataTransformerInterface
{
    /**
     * @param boolean|null $cb
     * @return boolean
     */
    public function transform($cb)
    {
        return $cb;
    }

    /**
     * @param  boolean $cb
     * @return boolean
     */
    public function reverseTransform($cb)
    {
        return $cb;
    }
} 