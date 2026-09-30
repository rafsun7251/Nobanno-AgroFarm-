<?php

require_once __DIR__ . '/BaseController.php';

class HomeController extends BaseController
{
    public function index(): void
    {
        $this->view(
            'home/index'
        );
    }
}