<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use romanzipp\Twitch\Twitch;
use App\Models\Game;
use App\Models\Stream;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;


class FillDatabase implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $twitch;

    private $data = [];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->twitch = new Twitch;
        $this->twitch->setClientId(config('services.twitch.client_id'));
        $this->twitch->setClientSecret(config('services.twitch.client_secret'));
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        Schema::disableForeignKeyConstraints();
        Stream::truncate();
        Game::truncate();
        Tag::truncate();
        \DB::table('streams_tags')->truncate();
        Schema::enableForeignKeyConstraints();
        $currentResult = null;
        for ($i = 0; $i<10; $i++) {
            if ($i == 0) {
                $currentResult = $this->twitch->getStreams(['first' => 100]);
            } else {
                $currentResult = $this->twitch->getStreams(['first' => 100], $currentResult->next());
            }
            foreach($currentResult->data() as $row) {
                Game::firstOrCreate(['id' => (int)$row->game_id, 'name' => (int)$row->game_id === 0 ? 'Unknown' : $row->game_name]);
                Stream::firstOrCreate([
                    'id' => (int)$row->id,
                    'title' => $row->title,
                    'viewer_count' => (int)$row->viewer_count,
                    'started_at' => Carbon::createFromTimeString($row->started_at)
                ]);
                $currentStream = Stream::whereId($row->id)->first();
                $currentGame = Game::whereId($row->game_id)->first();
                $currentStream->game()->associate($currentGame)->save();
                if(!is_null($row->tag_ids)) {
                    foreach($row->tag_ids as $tag) {
                        Tag::firstOrCreate(['tag_hash' => $tag]);
                        $currentTag = Tag::where('tag_hash', '=', $tag)->first();
                        $currentStream->tags()->attach($currentTag);
                    }
                }

            }
        }

        Tag::chunk(100, function($tags) {
            $params = [];
            foreach($tags as $tag) {
                $params[] = $tag->tag_hash;
            }
            $result = $this->twitch->getAllStreamTags(['tag_id' => $params]);
            foreach($result->data() as $res) {
                $names = (array)$res->localization_names;
                Tag::where('tag_hash', '=', $res->tag_id)->update(['name' => !isset($names['en-us']) ? array_pop($names) : $names['en-us']]);
            }
        });
    }
}
