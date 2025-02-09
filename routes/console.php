<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
// 追加
use Illuminate\Support\Facades\Schedule;

// 呼び出し: php artisan inspire
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// 追加
// 呼び出し: php artisan schedule:run
Schedule::call(function(){
    logger()->info('write to logger...');
    dd('こんにちは');
})->everyFiveSeconds();
// 自作commandによる別の書き方
// 呼び出し: php artisan app:greetings
Schedule::command('app:greetings')->everyFiveSeconds();

// docker compose logs -f app でログを確認
