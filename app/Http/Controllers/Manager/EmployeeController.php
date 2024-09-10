<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\Employee\StoreEmployeeRequest;
use App\Http\Requests\Manager\Employee\UpdateEmployeeRequest;
use App\Services\Manager\EmployeeService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected $service;

    public function __construct(EmployeeService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request){
        return $this->service->index($request);
    }

    public function store(StoreEmployeeRequest $request){
        return $this->service->store($request);
    }

    public function update(UpdateEmployeeRequest $request,$id){
        return $this->service->update($request,$id);
    }

    public function destroy($id){
        return $this->service->destroy($id);
    }
}
