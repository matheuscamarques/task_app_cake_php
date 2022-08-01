<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     3.0.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\View;

use Cake\View\View;

/**
 * Application View
 *
 * Your application's default view class
 *
 * @link https://book.cakephp.org/3/en/views.html#the-app-view
 */
class AppView extends View
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading helpers.
     *
     * e.g. `$this->loadHelper('Html');`
     *
     * @return void
     */
    public function initialize()
    {
    }

    public function task_overview($tasks_arr)
    {
        $task_arr_idx = array_map(fn ($task) => $task->id, $tasks_arr);

        $past_tasks = array_filter(
            $tasks_arr,
            fn ($task) =>
            $this->Time->isPast($task->expires_at) && !$this->Time->isToday($task->expires_at)
        );

        $day_tasks         = array_filter($tasks_arr, fn ($task) => $this->Time->isToday($task->expires_at));
        $day_tasks_arr_idx = array_map(fn ($task) => $task->id, $day_tasks);

        $week_tasks = array_filter($tasks_arr, fn ($task) => $this->Time->isThisWeek($task->expires_at));
        $week_tasks_visible = array_filter($tasks_arr, fn ($task) => $this->Time->isThisWeek($task->expires_at) && !in_array($task->id, $day_tasks_arr_idx));
        $week_tasks_arr_idx = array_map(fn ($task) => $task->id, $week_tasks);

        $next_tasks_arr_idx = array_diff($task_arr_idx, $week_tasks_arr_idx);
        $next_tasks = array_filter($tasks_arr, fn ($task) =>
        in_array($task->id, $next_tasks_arr_idx) && $this->Time->isFuture($task->expires_at));

        return [
            'Past Tasks'  => $past_tasks,
            'Daily Tasks' => $day_tasks,
            'Week Tasks'  => $week_tasks,
            'Next Tasks'  => $next_tasks
        ];



    }
}
