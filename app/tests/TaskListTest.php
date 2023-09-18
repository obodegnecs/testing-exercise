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

        $this->assertEquals($new_task, $task_list->get(0));
    }

}