<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
// 追加
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// 追加
Schedule::call(function(){
    dd('こんにちは');
})->everySecond();
// 自作commandによる別の書き方
Schedule::command('app:greetings')->everySecond();
