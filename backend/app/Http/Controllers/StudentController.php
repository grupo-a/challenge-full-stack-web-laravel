<?php

namespace App\Http\Controllers;

use App\Http\Resources\Student as ResourcesStudent;
use App\Http\Resources\StudentCollection;
use App\Models\Student;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class StudentController extends Controller
{
    public function index()
    {
        return new StudentCollection(Student::all());
    }

    public function show($id)
    {
        try {
            return new ResourcesStudent(Student::findOrFail($id));
        } catch (ModelNotFoundException $ex) {
            throw new HttpException(404, 'Aluno não encontrado!\nVerifique o identificador informado.');
        }
    }
}
