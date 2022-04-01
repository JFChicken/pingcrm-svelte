<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class ReportsController extends Controller
{
    public function index()
    {


      $data = ['fixed'];
      return Inertia::render('Reports/Index',['data'=>$data]);
    }
}
