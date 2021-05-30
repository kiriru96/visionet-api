<?php
namespace App\Controller;
use System\Controller as Controller;

class Api extends Controller {
    public function __construct() {
        // if token is not null and token has a data return not error
        $second = strtolower($this->req?->getUri()?->getSecondPath());

        if($second !== 'authentication') {

        }
        // echo $this->req?->getUri()?->getSecondPath();
    }

    public function index() {
        $this->res?->json(array('version'=>'0.1.0', 'name'=>'visionet'));
    }

    public function dashboardinfo() {
        if($this->req?->getMethod() === 'GET') {

        }
    }

    public function account() {
        if($this->req?->getMethod() === 'GET') {

        }
    }

    public function device() {
        if($this->req?->getMehod() === 'GET') {

        }
    }

    public function submitdevice() {
        if($this->req?->getMethod() === 'POST') {

        }
    }

    public function location() {
        if($this->req?->getMethod() === 'GET') {

        }
    }

    public function submitlocation() {
        if($this->req?->getMethod() === 'POST') {
            
        }
    }

    public function syslog() {
        if($this->req?->getMethod() === 'GET') {
            $date = $this->req->Get('date');

        }
    }

    public function authentication() {
        if($this->req?->getMethod() === 'POST') {
            $username = $this->req->Post('username');
            $password = $this->req->Post('password');
            $type     = $this->req->Post('type');

            if($username !== '' && $password !== '' && $type >= 0 && $type < 4) {
                // check username and type
                // if username is found in table get row of data and get password coloum
                // check if password in database is verified with password from request

                
            }
        }
    }

    public function addadmin() {
        if($this->req?->getMethod() === 'POST') {
            $fullname   = $this->req?->Post('fullname');
            $username   = $this->req?->Post('username');
            $password   = $this->req?->Post('password');

            
        }
    }
}