<?php

namespace App\Console\Commands;

use App\Jobs\ClearVoteJob;
use Illuminate\Console\Command;

class ClearVote extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vote:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Truncate votes table';



    public function handle()
    {
        dispatch(new ClearVoteJob());
    }
}
