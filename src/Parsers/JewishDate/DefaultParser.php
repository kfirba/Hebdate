<?php

namespace Domanage\Parsers\JewishDate;

use Domanage\Parsers\Parser;

class DefaultParser extends Parser
{
    /**
     * Handle the parse request.
     *
     * @return mixed
     */
    public function handle()
    {
        return explode(' ', $this->date);
    }
}