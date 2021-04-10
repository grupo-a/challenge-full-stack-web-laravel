<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentCollection;
use App\Models\Student;

class StudentController extends Controller
{
    public function index(){
        return new StudentCollection(Student::all());
    }
}
