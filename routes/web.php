<?php

use Illuminate\Support\Facades\Route;
use App\Models\Task;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/task-list', function () {
    $taskList = Task::get();
    return response()->json($taskList);
});

Route::post('/add-task', function (Request $request) {
    $title = $request->input('title');
    $description = $request->input('description');
    $priority = $request->input('priority');
    $addTask = new Task([
        'title' => $title,
        'description' => $description,
        'priority' => $priority,
    ]);
    $addTask->save();
    return response()->json(['message' => 'Task Added successfully']);
});

Route::post('/update-task', function (Request $request) {
    $id = $request->input('updateItemId');
    $status = $request->input('status');
    $statusValue;
    if($status == 1){
        $statusValue = true;
    }
    else{
        $statusValue = false;
    }

    $updateTask = Task::find($id);
    $updateTask->completed = $statusValue;
    $updateTask->save();
    return response()->json(['message' => 'Task Status Updated successfully']);
});

Route::post('/change-task-priority', function (Request $request) {
    $id = $request->input('changePriorityItemId');
    $priority = $request->input('priority');
    $updateTask = Task::find($id);
    $updateTask->priority = $priority;
    $updateTask->save();
    return response()->json(['message' => 'Task Status Updated successfully']);
});

Route::post('/delete-task', function (Request $request) {
    $taskId = $request->input('taskId');
    $task = Task::find($taskId);
    if($task){
        $task->delete();
        return response()->json(['message' => 'Task deleted successfully']);
    }else{
        return response()->json(['error' => 'Task not found'], 404);
    }
})->name('delete-task');

