<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Marquine\Etl\Job;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect()->route('ordenestrabajo.index');
    }

    public function etl(){

    $query = 'select * from users where status = ?';
    $options = [
        'bindings' => ['active']
    ];


    Job::start()->extract('query', $query, $options)
    ->transform('trim', ['columns' => ['name', 'email']])
    ->load('table', 'users');

    }
}
