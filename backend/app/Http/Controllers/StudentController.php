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
        $studentCollection = new StudentCollection(Student::all());
        return $studentCollection->response()->setStatusCode(200);
    }

    public function show($id)
    {
        try {
            $resourceStudent = new ResourcesStudent(Student::findOrFail($id));
            return $resourceStudent->response()->setStatusCode(200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Aluno não encontrado! Verifique o identificador informado.'])->setStatusCode(404);
        }
    }
}
