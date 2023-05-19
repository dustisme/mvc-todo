<?php
    class Task {
        protected int $taskId;
        protected string $taskDescription;
        protected string $username;
        protected $startingDate;
        protected $finishedDate;
        private string $status;

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
        function getTaskDescription() {
            return $this->taskDescription;
        }
        function getUsername() {
            return $this->username;
        }
        function getStartingDate() {
            return $this->startingDate;
        }
        function getFinishedDate() {
            return $this->finishedDate;
        }
        function getStatus() {
            return $this->status;
        }

        //setters
        function setId(int $taskId) {
            $this->taskId = $taskId;
        }
        function setTaskDescription(string $taskDescription) {
            $this->taskDescription = $taskDescription;
        }
        function setUsername(string $username) {
            $this->username = $username;
        }
        function setStartingDate($startingDate) {
        $this->startingDate = $startingDate;
        }
        function setFinishedDate($finishedDate) {
            $this->finishedDate = $finishedDate;
        }
        function setStatus(string $status) {
            $this->status = $status;
        }
    }