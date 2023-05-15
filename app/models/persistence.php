<?php 
include 'Task.php';

class Persistence implements PersistenceInterface {
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
    function editTask($task_id) {
        $this->searchTask($task_id)->username = $_POST['username'];
        $this->searchTask($task_id)->task = $_POST['task_description'];
        $this->searchTask($task_id)->status = $_POST['status'];
        $this->searchTask($task_id)->startingDate = $_POST['starting_date'];
        $this->searchTask($task_id)->finishedDate = $_POST['finished_date'];
        $this->addDataToJson($this->task_array);
        return $this->task_array;
    }
    function addTask() {
        $task = new Task("","", '');
        $this->track_id += 1;
        $task->task_id = $this->track_id;
        array_push($this->task_array[], $task);
        return $this->addDataToJson($this->task_array);
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