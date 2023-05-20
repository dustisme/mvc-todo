<?php
include 'Task.class.php';

class Persistence implements persistenceInterface
{
    private array $taskArray = array();
    //atribut per generar noves id
    private int $trackId = 0;

    function __construct()
    {
        if (file_exists(dirname(__DIR__) . '\..\web\json\data.json')) {
            $this->taskArray = json_decode(file_get_contents(dirname(__DIR__) . '\..\web\json\data.json'), true);
        }
    }
    function listTasks()
    {
        return $this->taskArray;
    }
    function viewTask($taskId)
    {
        $tasks = $this->taskArray;
        foreach ($tasks as $task) {
            if ($task['id'] == $taskId) {
                return $task;
            }
        }
        return null;
    }
    function updateTask($taskId, array $data)
    {
        $tasks = $this->taskArray;
        foreach ($tasks as $task) {
            if ($task['id'] == $taskId) {
                $task['username'] = $data['username'];
                $task['taskDescription'] = $data['taskDescription'];
                $task['status'] = $data['status'];
                $task['startingDate'] = $data['startingDate'];
                $task['finishedDate'] = $data['finishedDate'];
            }
        }
        $this->addDataToJson($tasks);
    }
    function addTask(array $data)
    {
        $task = array();
        $this->trackId = end($this->taskArray)['id'] + 1;
        $task['id'] = $this->trackId;
        $task['username'] = $data['username'];
        $task['taskDescription'] = $data['taskDescription'];
        $task['status'] = $data['status'];
        $task['startingDate'] = $data['startingDate'];
        $task['finishedDate'] = $data['finishedDate'];
        array_push($this->taskArray, $task);
        $this->addDataToJson($this->taskArray);
        return $task;
    }
    //busca una tasca a partir de l'id i la elimina
    function deleteTask($taskId)
    {
        $tasks = $this->taskArray;
        foreach ($tasks as $i => $task) {
            if ($task['id'] == $taskId) {
                unset($task[$i]);
            }
        }
        $this->addDataToJson($this->taskArray);
        // return $this->task_array;
    }
    //busca una tasca a prtir de l'id
    // function searchTask($taskId)
    // {
    //     foreach ($this->taskArray as $task) {
    //         if ($task['0'] == $taskId) {
    //             return $task;
    //         }
    //     }
    //     return false;
    // }
    // function setNewId()
    // {
    //     $lastTask = end($this->taskArray);
    //     $this->trackId = $lastTask['id'] + 1;
    //     return $this->trackId;
    // }
    //codifica l'array en un arxiu json i el posa bonic
    function addDataToJson($taskArray)
    {
        file_put_contents(dirname(__DIR__) . '\..\web\json\data.json', json_encode($taskArray, JSON_PRETTY_PRINT));
    }
}