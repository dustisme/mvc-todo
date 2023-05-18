<?php
include 'Task.php';

class Persistence implements persistenceInterface
{
    private array $task_array = array();
    private int $track_id;

    function __construct()
    {
        if (file_exists(dirname(__DIR__) . '\..\web\json\data.json')) {
            $this->task_array = json_decode(file_get_contents(dirname(__DIR__) . '\..\web\json\data.json'));
        }
        $this->track_id = end($this->task_array)->id;
    }
    function listTasks()
    {
        return $this->task_array;
    }
    function viewTask($task_id)
    {
        return $task = $this->searchTask($task_id);
    }
    function updateTask($task_id, Array $data)
    {
        $this->searchTask($task_id)->username = $data[1];
        $this->searchTask($task_id)->taskDescription = $data[2];
        $this->searchTask($task_id)->status = $data[3];
        $this->searchTask($task_id)->startingDate = $data[4];
        $this->searchTask($task_id)->finishedDate = $data[5];

        // $task->username = $data[1];
        // $task->task = $data[2];
        // $task->status = $data[3];
        // $task->startingDate = $data[4];
        // $task->finishedDate = $data[5];
        $this->addDataToJson($this->task_array);
    }
    function addTask()
    {
        $newId = $this->track_id + 1;
        $task = new Task($newId, "", "", '');
        array_push($this->task_array, $task);
        $this->addDataToJson($this->task_array);
    }
    function deleteTask($task_id)
    {
        $del_task = $this->searchTask($task_id);
        unset($del_task);
        return $this->addDataToJson($this->task_array);
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
    function addDataToJson($task_array)
    {
        file_put_contents(dirname(__DIR__) . '\..\web\json\data.json', json_encode($task_array, JSON_PRETTY_PRINT));
    }
}