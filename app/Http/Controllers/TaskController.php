<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    public function index()
    {
        try {
            $tasks = Task::get();

            return response()->json([
                'status' => 'success',
                'message' => 'Lista de tareas',
                'tasks' => $tasks
            ], Response::HTTP_OK); // 200
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'error' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST); // 400
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|min:4',
                'description' => 'required|min:4',
            ]);

            Task::create([
                'title' => $request->title,
                'description' => $request->description,
                'state' => false
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Se creo la tarea exitosamente',
            ], Response::HTTP_CREATED); // 201
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'error' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST); // 400
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'title' => 'required|min:4',
                'description' => 'required|min:4',
            ]);

            Task::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Se actualizo la tarea con exito',
            ], Response::HTTP_OK); // 200
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'error' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST); // 400
        }
    }

    public function revert($id)
    {
        Task::find($id)->update([
            'state' => false
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'La tarea se a revertido',
        ], Response::HTTP_OK); // 200
    }

    public function finished($id)
    {
        Task::find($id)->update([
            'state' => true
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'La tarea se finalizo',
        ], Response::HTTP_OK); // 200
    }

    public function destroy($id)
    {
        try {
            Task::find($id)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Se elimino la tarea con exito'
            ], Response::HTTP_OK); // 200
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'error' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST); // 400
        }
    }
}
