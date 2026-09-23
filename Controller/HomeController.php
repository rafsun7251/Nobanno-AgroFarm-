<?php

class HomeController
{
    public function index()
    {
        $pageTitle = 'Home';

        require BASE_PATH
            . '/View/home/index.php';
    }
}