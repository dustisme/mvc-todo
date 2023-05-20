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
    public function createTaskAction() {
        $this->view->viewTask = $this->persistence->viewTask($this->_namedParameters['id']);
    }
    public function addTaskAction()
    {
        $this->persistence->addTask($_POST);
        header("Location: " . WEB_ROOT . "/");
    }
    public function deleteTaskAction()
    {
        $this->persistence->deleteTask($this->_namedParameters['id']);
        header("Location: " . WEB_ROOT . "/");
    }
}