<?php

namespace App\Console\Commands;

use Laravel\Octane\Commands\StartFrankenPhpCommand as BaseStartFrankenPhpCommand;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'octane:frankenphp')]
class OctaneStartFrankenPhpCommand extends BaseStartFrankenPhpCommand
{
    /**
     * Returns the list of signals to subscribe.
     */
    public function getSubscribedSignals(): array
    {
        if (PHP_OS_FAMILY === 'Windows') {
            return [];
        }

        return parent::getSubscribedSignals();
    }
}
