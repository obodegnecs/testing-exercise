<?php
use App\Task\TaskList;
use PHPUnit\Framework\TestCase;

class TaskListTest extends TestCase
{
    public function testNullReturnedFromGetWhenEmpty() {
        $task_list = new TaskList();

        $this->assertNull($task_list->get(0));
    }

}