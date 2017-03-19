<?php

namespace PurpleBooth\Controllers;

/**
 * Index controller.
 */
class Index
{
    /**
     * @return string
     */
    public function indexAction()
    {
        ob_start();
        require __DIR__.'/../../../views/index.phtml';

        $output = ob_get_contents();
        ob_end_clean();

        return $output;
    }
}
