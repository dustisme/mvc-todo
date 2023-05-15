<?php

/**
 * Base controller for the application.
 * Add general things in this controller.
 */
class ApplicationController extends Controller 
{
	private $persistence;
    public function __construct() {
        $this->persistence = new Persistence();
    }
    public function indexAction() {
        $this->view->listTasks = $this->persistence->listTasks();
    }
    public function viewTaskAction() {
        $this->view->viewTask = $this->persistence->viewTask($this->_namedParameters['id']);
    }
    public function editTaskAction() {
        $this->view->editTask = $this->persistence->editTask($this->_namedParameters['id']);
    }
    public function addTaskAction() {
        $this->persistence->addTask();
        header ("Location: " . WEB_ROOT . "/");
    }
    public function deleteTaskAction() {
        $this->persistence->deleteTask($_POST['id']);
        header ("Location: " . WEB_ROOT . "/");
    }
}
