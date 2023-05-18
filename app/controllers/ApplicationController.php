<?php

/**
 * Base controller for the application.
 * Add general things in this controller.
 */
class ApplicationController extends Controller
{
    private $persistence;
    public function __construct()
    {
        $this->persistence = new Persistence();
    }
    public function indexAction()
    {
        $this->view->listTasks = $this->persistence->listTasks();
    }
    public function viewTaskAction()
    {
        $this->view->viewTask = $this->persistence->viewTask($this->_namedParameters['id']);
    }
    public function editTaskAction()
    {
        $this->view->viewTask = $this->persistence->viewTask($this->_namedParameters['id']);
    }
    public function updateTaskAction()
    {
        $this->persistence->updateTask($this->_namedParameters['id'], $_POST);
        header("Location: " . WEB_ROOT . "/");
    }
    public function addTaskAction()
    {
        $isValid = true;

        $errors = [
            'id' => '',
            'user' => "",
            'task' => "",
            'status' => "",
            'start_date' => "",
        ];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            //start validation
            if (!$data['user']) {
                $isValid = false;
                $errors['user'] = 'Name is mandatory';
            }
            if (!$data['task']) {
                $isValid = false;
                $errors['task'] = 'Task is required';
            }
            //end validation
            if ($isValid) {
                $this->persistence->addTask();
                // header("Location: " . WEB_ROOT . "/");
                exit;
            }
        }
    }
    public function deleteTaskAction()
    {
        $this->persistence->deleteTask($_POST['id']);
        header("Location: " . WEB_ROOT . "/");
    }
}