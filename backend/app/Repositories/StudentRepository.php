<?php

namespace App\Repositories;

use App\Models\Student;
use App\Repositories\Contracts\StudentRepositoryInterface;

class StudentRepository implements StudentRepositoryInterface
{
    protected $entity;

    public function __construct(Student $student)
    {
        $this->entity = $student;
    }

    public function getAllStudents($per_page)
    {
        return $this->entity->paginate($per_page);
    }

    public function getStudent($id)
    {
        return $this->entity::findOrFail($id);
    }

    public function newStudent($data)
    {
        //Se fosse preciso fazer algum tratamento com a data recebida seria aqui
        return $this->entity->create($data);
    }

    public function updateStudent($id, $data)
    {
        //Se fosse preciso fazer algum tratamento com a data recebida seria aqui
        $student = $this->entity::findOrFail($id);
        $result = $student->update($data);
        return $student;
    }

    public function destroyStudent($id)
    {
        //Se fosse preciso fazer algum tratamento com a data recebida seria aqui
        $student = $this->entity::findOrFail($id);
        return $student->delete();
    }

}
