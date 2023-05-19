<?php
include 'Task.class.php';

class Persistence implements persistenceInterface
{
    private array $task_array = array();
    private int $track_id;

    function __construct()
    {
        if (file_exists(dirname(__DIR__) . '\..\web\json\data.json')) {
            $this->task_array = json_decode(file_get_contents(dirname(__DIR__) . '\..\web\json\data.json'));
        }
        // $this->track_id = 0;
    }
    function listTasks()
    {
        return $this->task_array;
    }
    function viewTask($task_id)
    {
        return $this->searchTask($task_id);
    }
    function updateTask($task_id, array $data)
    {
        $task = $this->searchTask($task_id);
        if (!empty($data['useranme'] || $data['taskDescription'] || $data['status'] || $data['sartingDate'] || $data['finishedDate'])) {
            $task->username = $data['username'];
            $task->taskDescription = $data['taskDescription'];
            $task->status = $data['status'];
            $task->startingDate = $data['startingDate'];
            $task->finishedDate = $data['finishedDate'];
        }
        $this->addDataToJson($this->task_array);
    }
    function addTask(array $data)
    {
        $task = new Task("", "", "", '');
        $task->setId($this->setNewId());
        // if(empty($data['useranme'] || $data['taskDescription'] || $data['status'] || $data['sartingDate'] || $data['finishedDate'])) {
        // $task->username = $data['username'];
        // $task->taskDescription = $data['taskDescription'];
        // $task->status = $data['status'];
        // $task->startingDate = $data['startingDate'];
        // $task->finishedDate = $data['finishedDate'];
    // }
        array_push($this->task_array, $task);
        $this->addDataToJson($this->task_array);
        return $this->task_array;
    }
    function deleteTask($task_id)
    {
        $del_task = $this->searchTask($task_id);
        unset($del_task);
        $this->addDataToJson($this->task_array);
        return $this->task_array;
    }
    function searchTask($task_id)
    {
        foreach ($this->task_array as $sel_task) {
            if ($sel_task->id == $task_id) {
                return $sel_task;
            }
        }
        return false;
    }
    function setNewId()
    {
        $lastTask = end($this->task_array);
        $newId = $lastTask->id + 1;
        return $newId;
    }
    function addDataToJson($task_array)
    {
        file_put_contents(dirname(__DIR__) . '\..\web\json\data.json', json_encode($task_array, JSON_PRETTY_PRINT));
    }
}