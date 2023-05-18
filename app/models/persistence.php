<?php 
include 'Task.php';

class Persistence implements persistenceInterface {
    private Array $task_array = array();
    private int $track_id;

    function __construct() {
        if(file_exists(dirname(__DIR__) . '\..\web\json\data.json')) {
            $this->task_array = json_decode(file_get_contents(dirname(__DIR__) . '\..\web\json\data.json'));
        }
        $this->track_id = end($this->task_array)->id;
    }
    function listTasks() {
        return $this->task_array;
    }
    function viewTask($task_id) {
        return $this->searchTask($task_id);
    }
    function updateTask($task_id, $username, $taskDescription, $status, $startingDate, $finishedDate) {
        $task = $this->searchTask($task_id);
        $task->username = $username;
        $task->task = $taskDescription;
        $task->status = $status;
        $task->startingDate = $startingDate;
        $task->finishedDate = $finishedDate;
        $this->addDataToJson($this->task_array);
        return $task;
    }
    function addTask() {
        $newId = $this->track_id + 1;
        $task = new Task($newId, "","", '');
        array_push($this->task_array, $task);
        $this->addDataToJson($this->task_array);
    }
    function deleteTask($task_id) {
        $del_task = $this->searchTask($task_id);
        unset($del_task);
        return $this->addDataToJson($this->task_array);
    }
    function searchTask($task_id) {
        foreach($this->task_array as $sel_task) {
            if($sel_task->id == $task_id) {
                return $sel_task;
            }
        }
        return false;
    }
    function addDataToJson($task_array) {
        file_put_contents(dirname(__DIR__) . '\..\web\json\data.json', json_encode($task_array, JSON_PRETTY_PRINT));
    }
}