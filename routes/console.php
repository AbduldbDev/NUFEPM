<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('maintenance:check')->dailyAt('00:00');
Schedule::command('sos:check')->everyFiveMinutes();
