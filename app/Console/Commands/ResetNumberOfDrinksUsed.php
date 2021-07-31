<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ResetNumberOfDrinksUsed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset-number-of-drinks-used';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset Number Of Drinks Used On The Last Of Day';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        User::query()->update(['number_of_drinks_used' => 0]);
    }
}
