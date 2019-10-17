<?php

class Partner_Middleware extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($_SESSION['Account']['Type'] == 0) {
            Redirect('/Admin');
        }

        if ($_SESSION['Account']['Type'] == 2) {
            Redirect('/Outlet');
        }
        
        if (!isset($_SESSION['Account'])) {
            Redirect('/');
        }
    }
}
