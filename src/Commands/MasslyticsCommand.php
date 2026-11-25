<?php

namespace SwitchNetwork\Masslytics\Commands;

use Illuminate\Console\Command;

class MasslyticsCommand extends Command
{
    public $signature = 'masslytics-client';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
