<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtener todos las tareas
        $tasks = Task::all();

        // Devolver los registros como respuesta JSON
        return response()->json($tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Validar los datos del formulario
            $request->validate([
                'title' => 'required|string',
                'description' => 'required|string',
                'completed' => 'required|in:1,2,3', // solo  valores permitidos
            ]);
    
            // Crear una nueva instancia de Task con los datos del formulario
            $task = new Task();
            $task->title = $request->title;
            $task->description = $request->description;
            $task->completed = $request->completed;
            // Otros campos de la tarea si los hay
    
            // Guardar la tarea en la base de datos
            $task->save();
    
            // Retorna una respuesta de éxito y devolvemos la data de la tarea creada para fines de prueba del api
            return response()->json(['message' => 'Tarea creada exitosamente','data'=>$task], 201);
        } catch (\Exception $e) {
            // en caso de error devolvemmos
            return response()->json(['message' => 'Error al crear la tarea', 'error' => $e->getMessage(),'status' => 500], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    
        try {
            // Buscar la tarea por su ID
            $task = Task::findOrFail($id);
    
            // Actualizar el estado de la tarea
            $task->update([
                'completed' => $request->completed, // Actualiza el campo 'completed' con el valor recibido del formulario
            ]);
    
            // Devolver una respuesta exitosa
            return response()->json(['message' => 'Estado de la tarea actualizado correctamente'], 200);
        } catch (\Exception $e) {
            // Devolver una respuesta de error si ocurre algún problema
            return response()->json(['message' => 'Error al actualizar el estado de la tarea: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
