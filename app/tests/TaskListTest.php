<?php

use App\Task\Task;
use App\Task\TaskList;
use PHPUnit\Framework\TestCase;

class TaskListTest extends TestCase
{
    public function testNullReturnedFromGetWhenEmpty()
    {
        $task_list = new TaskList();

        $this->assertNull($task_list->get(0));
    }

    public function testSameTaskAddedAndReturnedFromTaskList()
    {
        $new_task = new Task();
        $task_list = new TaskList();

        $task_list->add($new_task);

        $this->assertSame($new_task, $task_list->get(0));
    }

    public function testSameThreeTaskAddedAndReturnedFromTaskList()
    {
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

    public function testNullReturnedFromGetByIdWhenIdNotInTaskList()
    {
        $new_task1 = new Task();
        $new_task1->id = 0;

        $new_task2 = new Task();
        $new_task2->id = 1;

        $task_list = new TaskList();

        $task_list->add($new_task1);
        $task_list->add($new_task2);

        $this->assertNull($task_list->getById(2));
    }

    public function testSameThreeTaskAddedAndReturnedByIdFromTaskList()
    {
        $new_task1 = new Task();
        $new_task1->id = 0;

        $new_task2 = new Task();
        $new_task2->id = 1;

        $task_list = new TaskList();

        $task_list->add($new_task1);
        $task_list->add($new_task2);

        $this->assertSame($new_task1, $task_list->getById(0));
        $this->assertSame($new_task2, $task_list->getById(1));
    }

    public function testExceptionThrownFromGetWhenIndexIsNegative()
    {
        $this->expectException(InvalidArgumentException::class);

        $task_list = new TaskList();
        $task_list->get(-1);
    }

    public function testSortByNameAscendingOrder()
    {
        $new_task1 = new Task();
        $new_task1->name = "Ironing the clothes"; // 1. in order
        $new_task1->id = 22;

        $new_task2 = new Task();
        $new_task2->name = "Loading the washing machine"; // 2. in order
        $new_task2->id = 2;

        $new_task3 = new Task();
        $new_task3->name = "Mopping the floor"; // 3. in order
        $new_task3->id = 222;

        $task_list = new TaskList();

        $task_list->add($new_task3);
        $task_list->add($new_task2);
        $task_list->add($new_task1);

        $task_list->sortByName();

        $this->assertSame($new_task1, $task_list->get(0));
        $this->assertSame($new_task2, $task_list->get(1));
        $this->assertSame($new_task3, $task_list->get(2));
    }

    public function testSortByIdAscendingOrder()
    {
        $new_task1 = new Task();
        $new_task1->name = "Write test";
        $new_task1->id = 4; // 1. in order

        $new_task2 = new Task();
        $new_task2->name = "Run test";
        $new_task2->id = 17; // 2. in order

        $new_task3 = new Task();
        $new_task3->name = "Write code";
        $new_task3->id = 34; // 3. in order

        $task_list = new TaskList();

        $task_list->add($new_task2);
        $task_list->add($new_task3);
        $task_list->add($new_task1);

        $task_list->sortById();

        $this->assertSame($new_task1, $task_list->get(0));
        $this->assertSame($new_task2, $task_list->get(1));
        $this->assertSame($new_task3, $task_list->get(2));
    }

    public function testExceptionThrownFromSortByWhenColumnInvalid()
    {
        $this->expectException(InvalidArgumentException::class);

        $task_list = new TaskList();
        $task_list->sortBy("category");
    }

    public function testSortByWhenColumnIsValid()
    {
        $new_task1 = new Task();
        $new_task1->name = "Write test"; // 3. NAME in order
        $new_task1->id = 3; // 1. ID in order

        $new_task2 = new Task();
        $new_task2->name = "Run test"; // 1. NAME in order
        $new_task2->id = 16; // 2. ID in order

        $new_task3 = new Task();
        $new_task3->name = "Write code";// 2. NAME in order
        $new_task3->id = 33; // 3. ID in order
        
        $task_list = new TaskList();

        $task_list->add($new_task3);
        $task_list->add($new_task2);
        $task_list->add($new_task1);

        $task_list->sortBy("id");

        $this->assertSame($new_task1, $task_list->get(0));
        $this->assertSame($new_task2, $task_list->get(1));
        $this->assertSame($new_task3, $task_list->get(2));

        $task_list->sortBy("name");

        $this->assertSame($new_task2, $task_list->get(0));
        $this->assertSame($new_task3, $task_list->get(1));
        $this->assertSame($new_task1, $task_list->get(2));
    }
}