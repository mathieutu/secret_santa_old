<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\MatchFound;
use Illuminate\Console\Command;

class FindMatchesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'secretsanta:matches';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::all();
        if ($users->count() < 2) {
            $this->error('Pas assez d\'utilisateurs.');

            return -1;
        }

        $senders = $users->shuffle();
        $receivers = collect($senders);
        $first = $receivers->shift();
        $receivers->push($first);

        $receivers = $receivers->values();
        $senders = $senders->values();
        foreach ($senders as $i => $sender) {
            $sender->receiver_id = $receivers[$i]->id;
            $sender->save();
        }

        // deuxième boucle au cas où ça plante lors de la première

        foreach ($senders as $i => $sender) {
            $sender->notify(new MatchFound);
        }

        return 0;
    }
}
