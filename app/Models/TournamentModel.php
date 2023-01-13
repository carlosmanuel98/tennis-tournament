<?php

namespace App\Models;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Ramsey\Collection\Collection;

class TournamentModel extends Model
{
    public $timestamps = false;

    protected $table = 'tbl_tournament';
    use HasFactory;

    public function get_report($data = [])
    {
        // dd($data);
        // DB::enableQueryLog();
        $id_tournament = $data['id_tournament'];
        $id_gender     = $data['id_gender'];
        $date          = $data['date'];
        $query = DB::table('tbl_tournament as TT');
       
        $query->select("TT.*",
                DB::raw("DATE_FORMAT(TT.timestamp, '%Y/%m/%d') AS date "),
                DB::raw("CONCAT_WS(' ',TP.first_name,TP.last_name) as player_win"),
                "TCG.description as category",
                "TG.result");

        $query->rightJoin('tbl_game AS TG', 'TT.id_tournament', '=', 'TG.id_tournament');
        $query->leftJoin('tbl_players AS TP', 'TG.id_player_win', '=', 'TP.id_player');
        $query->leftJoin('tbl_cat_gender AS TCG', 'TT.category_gender', '=', 'TCG.id_cat_gender');
        if ($id_tournament)     $query->where("TT.id_tournament", "$id_tournament");
        if (isset($id_gender))         $query->where("TT.category_gender", "$id_gender");
        if (isset($date))              $query->whereRaw("DATE(TT.timestamp)", "$date");
       
        $query->groupByRaw('TG.id_tournament');
        $query->groupByRaw('TG.id_player_win');
        $query->havingRaw("(COUNT('TG.id_player_win') > 1)");
        $report = $query->get();

        // $queries = DB::getQueryLog();
        // $last_query = end($queries);        
        // dd($last_query);
        return $report;
    }
}
