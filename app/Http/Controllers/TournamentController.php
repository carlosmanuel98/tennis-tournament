<?php

namespace App\Http\Controllers;

use App\Models\GameModel;
use App\Models\PlayerModel;
use App\Models\TournamentModel;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;

class TournamentController extends Controller
{
    //
    
    public function index()
    {

        $cat_gender = DB::table('tbl_cat_gender')->select('*')->where('active', 1)->get();
        $data_view['cat_gender'] = $cat_gender;

        return view('set_tournament', ['data' => $data_view]);
    }

    public function process_match($data = NULL, $id_tournament)
    {
        try {

            $result = self::game_simulator($data, NULL, $id_tournament);


            for ($i = 0; $i < (sizeof($result) / 2); $i++) {

                if ((sizeof($result) / 2) == 1) {
                    $stage = "Final";
                } elseif ((sizeof($result) / 2) >= 8) {
                    $stage = "Round of 16";
                    $i--;
                } elseif ((sizeof($result) / 2) >= 4) {
                    $stage = "Quarter finals";
                    $i--;
                } elseif ((sizeof($result) / 2) >= 2) {
                    $stage = "Semi-Final";
                    $i--;
                }

                $result = self::game_simulator($result, $stage, $id_tournament);
            }
        } catch (\Throwable $th) {
            echo 'Caught exception: ',  $th->getMessage(), "\n";
        }
    }




    public function game_simulator($dataWin, $stage = NULL, $id_tournament = NULL)
    {

        $round = 1;
        $count = 1;
        // dd($dataWin);
        $luck = rand(0, 100);
        $luck_two = rand(0, 100);
        $data_view = [];
        $view_render = "";
        foreach ($dataWin as $key => &$item) {

            if ($count == 2) {
                $inde = ($key - 1);
                $score_one = $dataWin[$inde]['score'];
                $score_two = $item['score'];

                //IS EQUAL SCORE; LUCK IS ADDED
                if ($score_one == $score_two) {
                    $score_one += $luck;
                    $score_two += $luck_two;
                }


                $msg_stage = $stage ? $stage : "STAGE $round";

                if ($score_two > $score_one && $score_one < $score_two) {
                    $item['id_player_win']              = $item['id_player'];
                    $dataWin[$inde]['id_player_lose']   = $dataWin[$inde]['id_player'];
                } else {
                    $dataWin[$inde]['id_player_win']    = $dataWin[$inde]['id_player'];
                    $item['id_player_lose']             = $item['id_player'];
                }



                $name_player_one = $dataWin[$inde]['first_name'] . " " . $dataWin[$inde]['last_name'];
                $name_player_two = $item['first_name'] . " " . $item['last_name'];

                $item['result']           = "$name_player_one  $score_one VS $score_two  $name_player_two";
                $dataWin[$inde]['result'] = "$name_player_one  $score_one VS $score_two  $name_player_two";

                $winner_score = ($score_one > $score_two) ? "{$name_player_one}" : "{$name_player_two}";


                $data_view['winner_score']    = $winner_score;
                $data_view['name_player_one'] = $name_player_one;
                $data_view['name_player_two'] = $name_player_two;
                $data_view['score_one']       = $score_one;
                $data_view['score_two']       = $score_two;
                $data_view['msg_stage']       = $msg_stage;

                $view_render .= view('result_tournament', ['data' => $data_view])->render();


                $count = 0;
                $round++;
            }

            $count++;
        }


        echo $view_render;

        // clean array to save
        $response = self::clean_array($dataWin);
        self::save_data($response, $id_tournament);

        return $response;
    }

    public function save_data($data, $id_tournament)
    {
        foreach ($data as $key => $value) {
            $game = new GameModel();
            $game->result = array_key_exists("result", $value) ? $value['result'] : '';
            $game->id_player_win = $value['id_player_win'];
            $game->id_tournament = $id_tournament;
            $game->timestamp = date('Y-m-d H:i:s');
            $game->save();
            $id_game = $game->id;
        }
    }

    public function clean_array($arrayData)
    {
        $arrayWin = [];
        foreach ($arrayData as $key => &$arrayItem) {
            if (array_key_exists("id_player_win", $arrayItem) && !array_key_exists("id_player_lose", $arrayItem)) {
                $arrayWin[] = $arrayItem;
            }
        }
        return $arrayWin;
    }

    public function generate_input(Request $request)
    {
        $player_num = $request->playerNum;
        $gender = $request->gender;
        $tournamentName = $request->tournamentName;
        $pow_number = pow(2, $player_num);


        $data_view = [];
        $cat_gender = DB::table('tbl_cat_gender')->select('*')->where('active', 1)->get();
        $cat_skills = DB::table('tbl_cat_skills')->select('*')->where('active', 1)->where('id_gender', $gender)->get();
        $data_view['cat_gender']         = $cat_gender;
        $data_view['cat_skills']         = $cat_skills;
        $data_view['pow_number']         = $pow_number;
        $data_view['gender']             = $gender;
        $data_view['tournamentName']     = $tournamentName;

        $view = view('template_player', ['data' => $data_view]);


        return response()->json([
            'view' => $view->render(),
            'type'     => 'success',

        ]);
    }
    public function save_players(Request $request)
    {
        $id_gender = $request['inputGenderTournament'];
        $tournament_name = $request['inputTournamentName'];

        //tournament insert
        $tournament = new TournamentModel();
        $tournament->name = $tournament_name;
        $tournament->timestamp = date('Y-m-d H:i:s');
        $tournament->category_gender = $id_gender;
        $tournament->save();
        $id_tournament = $tournament->id;


        foreach ($request['request'] as $key => $value) {
            $player = new PlayerModel();
            $player->first_name             = $value['inputName'];
            $player->last_name              =  $value['inputLastName'];
            $player->id_cat_gender          = $id_gender;
            $player->ability                = $value['inputAbility'];
            $player->power                  = isset($value['power']) ? $value['power'] : 0;
            $player->velocity_displacement  = isset($value['velocity_displacement']) ? $value['velocity_displacement'] : 0;
            $player->reaction_time          = isset($value['reaction_time']) ? $value['reaction_time'] : 0;
            $player->id_tournament          = $id_tournament;
            $player->timestamp              = date('Y-m-d H:i:s');
            $player->save();
            $id_player = $player->id;
        }


        $data = DB::table('tbl_players')->select('*', DB::raw('power+velocity_displacement+reaction_time+ability as score'))
            ->where("active", 1)
            ->where("id_tournament", $id_tournament)
            ->get();
        $data = json_decode(json_encode($data), true);

        self::process_match($data, $id_tournament);
    }

    public function report_dashboard()
    {
        $data_view = [];

        $tournament = DB::table('tbl_tournament')->select('*')->where('active', 1)->get();
        $cat_skills = DB::table('tbl_cat_skills')->select('*')->where('active', 1)->get();
        $cat_gender = DB::table('tbl_cat_gender')->select('*')->where('active', 1)->get();

        $data_view['cat_gender']         = $cat_gender;
        $data_view['tournament']         = $tournament;
        $data_view['cat_skills']         = $cat_skills;
        return view('report_dashboard', ['data' => $data_view]);
    }
    public function search_tournament(Request $request)
    {
       
        $arrayData = [
            'id_tournament' => $request->tournament,
            'id_gender'     => $request->gender,
            'date'          => $request->inputDate
        ];
        
        $tournament = new TournamentModel();
        $report = $tournament->get_report($arrayData);
       
        $report_validate = json_decode(json_encode($report), true);
        $response = !empty($report_validate) ? view('table_result', ['data' => $report])->render() : NULL;

        return response()->json([
            'view' => $response,
            'type'     => 'success',
        ]);
    }
}
