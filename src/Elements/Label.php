<?php

namespace Spatie\Html\Elements;

use Spatie\Html\BaseElement;

class Label extends BaseElement
{
    protected $tag = 'label';

    /**
     * @param string|null $for
     *
     * @return static
     */
    public function for_($for)
    {
        return $this->attribute('for', $for);
    }
}
