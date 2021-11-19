<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Stream;
use App\Models\Tag;
use App\Services\TwitchService;

class TwitchController extends Controller
{

    /**
     * @return \Illuminate\Http\Response
     */
    public function totalNumbers()
    {
        $games = Game::withCount('streams')->orderBy('streams_count', 'desc')->get();
        return view('pages/total-number-for-each-game', ['games' => $games]);
    }


    /**
     * @return \Illuminate\Http\Response
     */
    public function topGames()
    {
        $streams = Stream::with('game')->get();
        $results = [];
        foreach ($streams as $stream) {
            if(!isset($results[$stream->game_id])) {
                $results[$stream->game_id] = ['game' => $stream->game->name, 'viewer_count' => 0];
            }

            $results[$stream->game_id]['viewer_count'] += $stream->viewer_count;
        }
        usort($results, function($a, $b) {
            if($a['viewer_count'] === $b['viewer_count']) {
                return 0;
            }
            return ($a['viewer_count'] > $b['viewer_count']) ? -1 : 1;
        });

        return view('pages/top-games-by-viewers-count', ['results' => array_slice($results, 0, 20)]);
    }


    /**
     * @return \Illuminate\Http\Response
     */
    public function medianNumber()
    {
        $result = Stream::orderBy('viewer_count', 'desc')->pluck('viewer_count', 'id')->toArray();
        $result = array_values($result);
        $count = count($result);
        $mid = floor(($count-1)/2);
        return view('pages/median-number', ['number' => ($result[$mid]+$result[$mid+1-$count%2])/2]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function top100Streams(Request $request)
    {

        $results = Stream::whereIn(
            'id',
            Stream::select('id')->orderBy('viewer_count', 'desc')->limit(100)->pluck('id')
        );
        if($request->has('order') && $request->get('order') == 'asc') {
            $results->orderBy('viewer_count', 'asc');
        } else {
            $results->orderBy('viewer_count', 'desc');
        }

        return view('pages/top-100-streams-by-viewer-count', ['results' => $results->get()]);
    }


    /**
     * @return \Illuminate\Http\Response
     */
    public function streamsByStartDate()
    {
        $results = Stream::select(\DB::raw('COUNT(*) as cnt, CONVERT(started_at, VARCHAR(13)) as start_time'))
            ->groupBy('start_time')->orderBy('cnt', 'desc')->get()->toArray();
        return view('pages/streams-by-start-date', ['results' => $results]);
    }


    /**
     * @return \Illuminate\Http\Response
     */
    public function userFollowing()
    {
        $userData = TwitchService::getFollowedStreams();
        $ids = [];
        foreach($userData->data() as $row) {
            array_push($ids, (int)$row->id);
        }
        $streamsForUser = Stream::whereIn('id', $ids)->orderBy('viewer_count', 'desc')->get();
        return view('pages/user-following', ['results' => $streamsForUser]);
    }


    /**
     * @return \Illuminate\Http\Response
     */
    public function howMany()
    {
        $userData = TwitchService::getFollowedStreams();
        $lowerStream = null;
        foreach($userData->data() as $row) {
            if(is_null($lowerStream)) {
                $lowerStream = $row;
            }

            if((int)$lowerStream->viewer_count > (int)$row->viewer_count) {
                $lowerStream = $row;
            }
        }

        $streams = Stream::all();
        $minStream = null;
        foreach($streams as $stream) {
            if(is_null($minStream)) {
                $minStream = $stream;
            }

            if((int)$minStream->viewer_count > (int)$stream->viewer_count) {
                $minStream = $stream;
            }
        }

        return view('pages/how-many', ['minStream' => $minStream, 'lowerStream' => $lowerStream]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function sharedTags()
    {
        $userData = TwitchService::getFollowedStreams();
        $userTags = [];
        foreach($userData->data() as $row) {
            $userTags = array_merge($userTags, $row->tag_ids);
        }
        $userTags = array_unique($userTags);

        $tags = Tag::whereIn('tag_hash', $userTags)->get();

        return view('pages/shared-tags', ['results' => $tags]);
    }



}
