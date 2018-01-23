<?php

class HEAD_Controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct(); 
        $this->output->enable_profiler(ENVIRONMENT == 'development');
    }

}
