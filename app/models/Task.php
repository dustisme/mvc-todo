<?php
include_once 'Status.php';

    class Task {
        protected int $task_id;
        protected string $task_description;
        protected string $username;
        protected $starting_date;
        protected $finished_date;
        private Status $status;

        //Status is a constant var
        function __construct(string $task_description, string $username, $starting_date, Status $status = Status::executing) {
            $this->task_description = $task_description;
            $this->username = $username;
            $this->starting_date = $starting_date;
            $this->status = $status;
        }
        //getters
        function getId() {
            return $this->task_id;
        }
        function getTask_description() {
            return $this->task_description;
        }
        function getUsername() {
            return $this->username;
        }
        function getStarting_date() {
            return $this->starting_date;
        }
        function getFinished_date() {
            return $this->finished_date;
        }
        function getStatus() {
            return $this->status;
        }

        //setters
        function setTask_description(string $task) {
            $this->task_description = $task;
        }
        function setUsername(string $username) {
            $this->username = $username;
        }
        function setStarting_date(string $starting_date) {
        $this->starting_date = $starting_date;
        }
        function setFinished_date(string $finished_date) {
            $this->finished_date = $finished_date;
        }
        function setStatus(Status $status) {
            $this->status = $status;
        }
    }