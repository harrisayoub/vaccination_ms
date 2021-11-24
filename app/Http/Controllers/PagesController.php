<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function scheduler(){
      $title = 'Welcome to Farmer\'s Friend';
      return view('pages.index', compact('title'));
    }

    public function Inventory(){
      return view('pages.inventory');
    }

    public function bookkeeper(){
      return view('finance.bookkeeper');
    }
}
