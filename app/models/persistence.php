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
    function updateTask($task_id) {
        if ($this->searchTask($task_id) == $_GET['id']) {
            $this->searchTask($task_id)->username = $_POST['username'];
            $this->searchTask($task_id)->task = $_POST['task'];
            $this->searchTask($task_id)->status = $_POST['status'];
            $this->searchTask($task_id)->startingDate = $_POST['startingDate'];
            $this->searchTask($task_id)->finishedDate = $_POST['finishedDate'];
        } else {
            return dirname(__DIR__ ) . '\..\views\scripts\error\error.phtml';
        }
        array_merge($this->task_array, $this->searchTask($task_id));
        return $this->addDataToJson($this->task_array);
        // $this->searc = array_merge($this->task_array, $data);
        // return $this->addDataToJson($this->task_array);
        // $this->searchTask($task_id)->username = $_POST['username'];
        // $this->searchTask($task_id)->task = $_POST['task_description'];
        // $this->searchTask($task_id)->status = $_POST['status'];
        // $this->searchTask($task_id)->startingDate = $_POST['starting_date'];
        // $this->searchTask($task_id)->finishedDate = $_POST['finished_date'];
        // $this->addDataToJson($this->task_array);
        // return $this->addDataToJson($this->task_array);
    }
    function addTask() {
        $task = new Task($this->track_id += 1, "","", '');
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