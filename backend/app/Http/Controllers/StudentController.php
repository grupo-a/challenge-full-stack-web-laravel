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
        $student = $this->getStudentById($id);
        if (!isset($student)) {
            return response()->json(['error' => 'Aluno não encontrado! Verifique o identificador informado.'])->setStatusCode(404);
        }

        return $this->makeResponseWithStudentResource($student, 200);
    }

    public function store(Request $request)
    {
        $responseValidation = $this->validateStudentRequest($request, true);
        if (isset($responseValidation)) {
            return $responseValidation;
        }

        $student = Student::create($request->all());

        return $this->makeResponseWithStudentResource($student, 201);
    }

    public function edit($student_id, Request $request)
    {
        $student = $this->getStudentById($student_id);
        if (!isset($student)) {
            return response()->json(['error' => 'Aluno não encontrado! Verifique o identificador informado.'])->setStatusCode(404);
        }

        $responseValidation = $this->validateStudentRequest($request, false);

        if (isset($responseValidation)) {
            return $responseValidation;
        }

        foreach ($request->all() as $property_name => $property_value) {
            if (in_array($property_name, $student->editable)) {
                $student->$property_name = $property_value;
            }
        };

        $student->save();

        return $this->makeResponseWithStudentResource($student, 200);
    }

    public function delete($student_id)
    {
        $student = $this->getStudentById($student_id);
        if (!isset($student)) {
            return response()->json(['error' => 'Aluno não encontrado! Verifique o identificador informado.'])->setStatusCode(404);
        }

        $student->delete();

        return response()->noContent();
    }

    private function getStudentById($id)
    {
        try {
            $student = Student::findOrFail($id);
            return $student;
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    private function makeResponseWithStudentResource($student, $status_code)
    {
        $resourceStudent = new ResourcesStudent($student);

        return $resourceStudent
            ->response()
            ->setStatusCode($status_code);
    }

    private function validateStudentRequest($request, $with_required)
    {
        $rules = $this->getStudentValidationRules($with_required);

        $messages = $this->getStudentMessageRules($with_required);

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response($errors)->setStatusCode(400);
        }
    }

    private function getStudentValidationRules($with_required)
    {
        $rules = [
            'name' => ($with_required ? "required|" : "") . 'max:200',
            'email' => ($with_required ? "required|" : "") . 'max:100',
            'academic_register' => ($with_required ? "required|" : "") . 'max:40',
            'cpf' => ($with_required ? "required|" : "") . 'size:11',
        ];

        return $rules;
    }

    private function getStudentMessageRules($with_required)
    {
        $required_messages = [
            'name.required' => "O campo nome é obrigatório.",
            'email.required' => "O campo email é obrigatório.",
            'academic_register.required' => "O campo registro acadêmico é obrigatório.",
            'cpf.required' => "O campo cpf é obrigatório.",
        ];

        $size_messages = [
            'name.max' => "O campo nome pode conter no máximo 200 caracteres",
            'email.max' => "O campo email pode conter no máximo 100 caracteres",
            'academic_register.max' => "O campo registro acadêmico pode conter no máximo 40 caracteres",
            'cpf.size' => "O campo cpf deve conter 11 dígitos, somente números."
        ];

        return array_merge(($with_required ? $required_messages : []), $size_messages);
    }
}
