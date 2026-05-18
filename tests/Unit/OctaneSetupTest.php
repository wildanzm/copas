<?php

uses(TestCase::class);

use App\Console\Commands\OctaneStartCommand;
use App\Console\Commands\OctaneStartFrankenPhpCommand;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

test('registers custom octane start command', function () {
    $command = Artisan::all()['octane:start'] ?? null;

    expect($command)->not->toBeNull();
    expect($command)->toBeInstanceOf(OctaneStartCommand::class);
});

test('registers custom octane frankenphp command', function () {
    $command = Artisan::all()['octane:frankenphp'] ?? null;

    expect($command)->not->toBeNull();
    expect($command)->toBeInstanceOf(OctaneStartFrankenPhpCommand::class);
});
