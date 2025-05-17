<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Employee;
use App\Models\Department;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// ROTA PARA CRIAR UM FUNCIONÁRIO
Route::post('/employees', function (Request $request) {
    $employee = new Employee();

    $employee->name = $request->input('name');
    $employee->email = $request->input('email');
    $employee->position = $request->input('position');
    $employee->salary = $request->input('salary');
    $employee->department_id = $request->input('department_id');


    $employee->save();
    return response()->json($employee);
});

// ROTA PARA LISTAR FUNCIOÁRIOS COM DEPARTAMENTO
Route::get('/employees/department', function () {
    $employee = Employee::with('department')->get();
    return response()->json($employee);
});

// ROTA PARA LISTAR TODOS OS FUNCIONÁRIOS
Route::get('/employees', function () {
    $employee = Employee::all();
    return response()->json($employee);
});

// ROTA PARA LISTAR UM FUNCIONÁRIO
Route::get('/employees/{id}', function ($id){
    $employee = Employee::find($id);
    return response()->json($employee);
});

// ROTA PARA ATUALIZAR UM FUNCIONÁRIO
Route::patch('/employees/{id}', function (Request $request, $id) {
    $employee = Employee::find($id);
    if($request->input('name') !== null){
    $employee->name = $request->input('name');
    }
    if($request->input('email') !== null){
    $employee->email = $request->input('email');
    }
    if($request->input('position') !== null){
    $employee->position = $request->input('position');
    }
    if($request->input('salary') !== null){
    $employee->salary = $request->input('salary');
    }
    if($request->input('department_id') !== null){
    $employee->department_id = $request->input('department_id');
    }
    $employee->save();
    return response()->json($employee);
});

// ROTA PARA DELETAR UM FUNCIONÁRIO
Route::delete('/employees/{id}', function ($id){
    $employee = Employee::find($id);
    $employee->delete();
    return response()->json($employee);
});

//ROTA PARA BUSCAR UM DEPARTAMENTO DE UM FUNCIONÁRIO
Route::get('/employee/department/{id}', function($id){
    $employee = Employee::find($id);
    $department = $employee->department;

    return response()->json($department);
});

//-------------------------------------------------------------------------
//ROTAS PARA DEPARTAMENTO
//-------------------------------------------------------------------------

// ROTA PARA CRIAR UM DEPARTAMENTO
Route::post('/departments', function (Request $request) {
    $department = new Department();

    $department->name = $request->input('name');
    $department->email = $request->input('email');
    $department->employees_count = $request->input('employees_count');

    $department->save();
    return response()->json($department);
});

// ROTA PARA LISTAR DEPARTAMENTOS COM FUNCIONÁRIOS
Route::get('/departments/employees', function () {
    $department = Department::with('employees')->get();
    return response()->json($department);
});

// ROTA PARA LISTAR TODOS OS DEPARTAMENTOS
Route::get('/departments', function () {
    $department = Department::all();
    return response()->json($department);
});

// ROTA PARA LISTAR UM DEPARTAMENTO
Route::get('/departments/{id}', function ($id){
    $department = Department::find($id);
    return response()->json($department);
});

// ROTA PARA ATUALIZAR UM DEPARTAMENTO
Route::patch('/departments/{id}', function (Request $request, $id) {
    $department = Department::find($id);
    if($request->input('name') !== null){
    $department->name = $request->input('name');
    }
    if($request->input('email') !== null){
    $department->email = $request->input('email');
    }
    if($request->input('employees_count') !== null){
    $department->employees_count = $request->input('employees_count');
    }
    $department->save();
    return response()->json($department);
});

// ROTA PARA DELETAR UM DEPARTAMENTO
Route::delete('/departments/{id}', function ($id){
    $department = Department::find($id);
    $department->delete();
    return response()->json($department);
});

Route::get('/departments/employee/{id}', function($id){
    $department = Department::find($id);
    $employee = $department->employees;

    return response()->json($employee);
});