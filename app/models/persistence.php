<?php
// include 'persistenceInterface.php';

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
        $foundTask = false;
        for ($i = 0; $i < count($tasks) && !$foundTask; $i++) {
            if ($task['id'] == $taskId) {
                $foundTask = true;
                $task['username'] = $data['username'];
                $task['taskDescription'] = $data['taskDescription'];
                $task['status'] = $data['status'];
                $task['startingDate'] = $data['startingDate'];
                $task['finishedDate'] = $data['finishedDate'];
                $this->addDataToJson($tasks);
            }
        }
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
    function deleteTask($taskId)
    {
        $tasks = $this->taskArray;
        foreach ($tasks as $i => $task) {
            if ($task['id'] == $taskId) {
                unset($tasks[$i]);
            }
        }
        $this->addDataToJson($tasks);
    }
    function addDataToJson($taskArray)
    {
        file_put_contents(dirname(__DIR__) . '\..\web\json\data.json', json_encode($taskArray, JSON_PRETTY_PRINT));
    }
}