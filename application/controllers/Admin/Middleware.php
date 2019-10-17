<?php

class Middleware extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($_SESSION['Account']['Type'] == 1) {
            Redirect('/Partner');
        }

        if ($_SESSION['Account']['Type'] == 2) {
            Redirect('/Outlet');
        }
        
        if (!isset($_SESSION['Account'])) {
            Redirect('/');
        }
    }
}
