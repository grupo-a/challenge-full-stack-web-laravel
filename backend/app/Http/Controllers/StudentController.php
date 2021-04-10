<?php

namespace App\Http\Controllers;

use App\Http\Resources\Student as ResourcesStudent;
use App\Http\Resources\StudentCollection;
use App\Models\Student;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        $studentCollection = new StudentCollection(Student::all());
        return $studentCollection
            ->response()
            ->setStatusCode(200);
    }

    public function show($id)
    {
        try {
            $resourceStudent = new ResourcesStudent(Student::findOrFail($id));
            return $resourceStudent
                ->response()
                ->setStatusCode(200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Aluno não encontrado! Verifique o identificador informado.'])->setStatusCode(404);
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:200',
            'email' => 'required|max:100',
            'academic_register' => 'required|max:40',
            'cpf' => 'required|size:11',
        ];

        $messages = [
            'name.required' => "O campo nome é obrigatório.",
            'email.required' => "O campo email é obrigatório.",
            'academic_register.required' => "O campo registro acadêmico é obrigatório.",
            'cpf.required' => "O campo cpf é obrigatório.",
            'cpf.size' => "O campo cpf deve conter 11 dígitos, somente números."
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response($errors)->setStatusCode(400);
        }

        $student = Student::create($request->all());

        $resourceStudent = new ResourcesStudent($student);

        return $resourceStudent
            ->response()
            ->setStatusCode(201);
    }
}
