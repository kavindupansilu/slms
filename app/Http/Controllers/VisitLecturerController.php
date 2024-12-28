<?php

namespace App\Http\Controllers;

use App\Models\lecturer;
use App\Models\visitlecturer;
use Illuminate\Http\Request;

class VisitLecturerController extends Controller
{
    protected $visitlecturer;

    public function __construct()
    {

        $this->visitlecturer = new visitlecturer();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = VisitLecturer::all();
        return view('dashboard.visitlecturer', compact('users'));


    }

}