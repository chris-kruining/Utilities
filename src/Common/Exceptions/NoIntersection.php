<?php

namespace CPB\Utilities\Common\Exceptions
{
    class NoIntersection extends \OutOfBoundsException
    {
        public function __construct(\Throwable $previous = null)
        {
            parent::__construct(
                'No intersection was found',
                0,
                $previous
            );
        }
    }
}
