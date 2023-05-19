<?php
    class Task {
        protected int $taskId;
        public $username;
        public $taskDescription;
        public $status;
        public $startingDate;
        public $finishedDate;

        //Status is a constant var
        function __construct($username, $taskDescription, $status, $startingDate) {
            $this->username = $username;
            $this->taskDescription = $taskDescription;
            $this->status = $status;
            $this->startingDate = $startingDate;
        }
        //getters
        function getId() {
            return $this->taskId;
        }
        function getUsername() {
            return $this->username;
        }
        function getTaskDescription() {
            return $this->taskDescription;
        }
        function getStatus() {
            return $this->status;
        }
        function getStartingDate() {
            return $this->startingDate;
        }
        function getFinishedDate() {
            return $this->finishedDate;
        }

        //setters
        function setId(int $taskId) {
            $this->taskId = $taskId;
        }
        function setUsername(string $username) {
            $this->username = $username;
        }
        function setTaskDescription(string $taskDescription) {
            $this->taskDescription = $taskDescription;
        }
        function setStatus(string $status) {
            $this->status = $status;
        }
        function setStartingDate($startingDate) {
        $this->startingDate = $startingDate;
        }
        function setFinishedDate($finishedDate) {
            $this->finishedDate = $finishedDate;
        }
    }