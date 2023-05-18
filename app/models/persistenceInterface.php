<?php

interface PersistenceInterface {
    
    public function listTasks();
    public function viewTask($task_id);
    public function goToUpdateTask($task_id);
    public function updateTask($task_id, Array $data);
    public function addTask();
    public function deleteTask($task_id);
    public function searchTask($task_id);
    public function addDataToJson($task_array);
    //public function searchUsername($username_id);
}
