<?php

namespace NucleusOffice\View\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class ViewController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function home()
    {
        return view('view::index');
    }
}
