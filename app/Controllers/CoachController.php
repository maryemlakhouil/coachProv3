<?php
namespace App\Controllers;

use Core\Controller;
use App\Models\Coach;

class CoachController extends Controller
{
    public function index()
    {
        $coach = new Coach();
        $coaches = $coach->getAll();

        $this->view('coach/index', compact('coaches'));
    }
}
