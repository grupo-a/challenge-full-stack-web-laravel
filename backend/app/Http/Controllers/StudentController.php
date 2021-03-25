<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Services\StudentService;
use App\Http\Resources\StudentResource;
use App\Http\Requests\StudentFormRequest;

class StudentController extends Controller
{
    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = (int) $request->get('per_page', 15);

        $students = $this->studentService->getAllStudents($per_page);

        return StudentResource::collection($students);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentFormRequest $request)
    {
        $data = $request->all();

        $student = $this->studentService
                            ->createNewStudent($data);

        return (new StudentResource($student))
                    ->response()
                    ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new StudentResource( $this->studentService->getStudent($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudentFormRequest $request, $id)
    {
        $data = $request->all();

        $student = $this->studentService
                            ->updateStudent($id, $data);

        return (new StudentResource($student))
                    ->response()
                    ->setStatusCode(202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->studentService->destroyStudent($id)) {
            return response()->json(['message' => 'Student deleted'], 204);
        } else {
            return response()->json(['message' => 'Error to delete Student'], 400);
        }

    }
}
