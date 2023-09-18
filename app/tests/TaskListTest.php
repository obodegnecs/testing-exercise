<?php

use App\Task\Task;
use App\Task\TaskList;
use PHPUnit\Framework\TestCase;

class TaskListTest extends TestCase
{
    public function testNullReturnedFromGetWhenEmpty() {
        $task_list = new TaskList();

        $this->assertNull($task_list->get(0));
    }

    public function testAddingNewTaskToTaskList() {
        $new_task = new Task();
        $task_list = new TaskList();

        $task_list->add($new_task);

        $this->assertSame($new_task, $task_list->get(0));
    }

    public function testAddingThreeTasksToTaskList() {
        $new_task1 = new Task();
        $new_task2 = new Task();
        $new_task3 = new Task();
        $task_list = new TaskList();

        $task_list->add($new_task1);
        $task_list->add($new_task2);
        $task_list->add($new_task3);

        $this->assertSame($new_task1, $task_list->get(0));
        $this->assertSame($new_task2, $task_list->get(1));
        $this->assertSame($new_task3, $task_list->get(2));
    }

}