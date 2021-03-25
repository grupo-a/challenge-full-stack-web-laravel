<?php

namespace App\Repositories\Contracts;

interface StudentRepositoryInterface
{
    public function getAllStudents($per_page);
    public function getStudent($id);
    public function newStudent($data);
    public function updateStudent($id, $data);
    public function destroyStudent($id);

} 