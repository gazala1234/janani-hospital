<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewsCallController extends Controller
{
    // function to call dashboard
    public function index()
    {
        return view('dashboard');
    }

    //    function to call user settings page 
    public function getSettings()
    {
        return view('pages.addUserDetails');
    }

    // function to call book consult page 
    public function getBookConsult()
    {
        return view('pages.book-consult');
    }

    // function to call events page 
    public function getEvents()
    {
        return view('pages.event');
    }

}