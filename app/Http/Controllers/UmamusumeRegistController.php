<?php

namespace App\Http\Controllers;

use App\Models\character_data;
use App\Models\race_table;
use Illuminate\Http\Request;

class UmamusumeRegistController extends Controller
{

    // 各メンバ変数を定義
    //現在
    private $theCurrentSeason; //表示する画面上の時期を示す
    private $theCurrentDate; //表示する画面上の月を示す
    private $theCurrentIsFirst; //表示する画面上のデータが前半か後半かを示す

    //次
    private $nextSeason; //次に表示する画面上の時期を示す
    private $nextDate; //次に表示する画面上の時期を示す
    private $nextIsFirst; //次に表示する画面上の時期を示す

    //戻る
    private $returnSeason; //戻る場合に表示する画面上の時期を示す
    private $returnDate; //戻る場合に表示する画面上の時期を示す
    private $returnIsFirst; //戻る場合に表示する画面上の時期を示す


     /**
     * 画面遷移
     */
    public function display()
    {
        return view('common.Character');
    }

    /**
     * データを登録
     */
    public function regist(Request $request)
    {
        $umamusume = new character_data();
        $umamusume->id = character_data::max('id') + 1;
        $umamusume->name = $request->get('Uma_name');                
        $umamusume->Grass_Suitability = $request->get('grass');
        $umamusume->Dirt_Suitability = $request->get('dirt');
        $umamusume->Stayer_Suitability = $request->get('stayer');
        $umamusume->Classic_Suitability = $request->get('classic');
        $umamusume->Mile_Suitability = $request->get('mile'); 
        $umamusume->Sprint_Suitability = $request->get('sprint');
        $umamusume->Lead_Pace_Suitability = $request->get('lead_pece');
        $umamusume->Front_Runner_Suitability = $request->get('front_runner');
        $umamusume->Hold_Up_Runner_Suitability = $request->get('hold_up_runner');
        $umamusume->Late_Charge_Drive_Suitability = $request->get('late_charge_runner');
        $umamusume->Race_Chack_Field = json_encode($this->race_Data_Field_reset());
        $umamusume->save();
        return view('title');
    }

    /**
     * レース出走したか確認用テーブルに使うJSON配列を作成する
     */
    private function race_Data_Field_reset(){
        $race_data = race_table::all();
        $results = array();
        foreach($race_data as $race_data_item){
            $result['race_id'] = $race_data_item->race_id;
            $result["レース名"] = $race_data_item->racename;
            $result["馬塲"] = $race_data_item->ground;
            $result["距離"] = $race_data_item->distance;
            $generation = "";
            if($race_data_item->IS_junior){
                $generation = "ジュニア期";
                $result["season"] = 1;
            }else if($race_data_item->IS_classic && $race_data_item->IS_senior){
                $generation = "クラシック・シニア期";
                $result["season"] = 3;
            }else if($race_data_item->IS_classic){
                $generation = "クラシック期";
                $result["season"] = 2;
            }else{
                $generation = "シニア期";
                $result["season"] = 4;
            }
            if($race_data_item->is_First){
                $result["時期"] =  $generation.":".$race_data_item->date."月前半";
                $result["前後半"] = "前半";
            }else{
                $result["時期"] =  $generation.":".$race_data_item->date."月後半";
                $result["前後半"] = "後半";
            }
            $result["出走時期"] = $generation;
            $result["出走月"] = $race_data_item->date;
            $result["出走"] = "未";
            $results[] = $result;
            $result = null;
        }
        return $results;
    }   
    
     /**
     * 
     */
    public function regist_race(){
        return view('common.race_view');
    }

    public function regist_race_data(Request $request){
        $race_data = new race_table();
        $race_data->race_id = race_table::max('race_id') + 1;
        $race_data->racename = $request->get('race_name'); 
        $race_data->rank = $request->get('rank');
        $race_data->ground = $request->get('ground');
        $race_data->distance = $request->get('distance');
        $race_data->date = $request->get('date');
        $race_data->is_First = $request->get('is_First');
        $race_data->IS_junior = $request->get('is_junior');
        $race_data->IS_classic = $request->get('is_classic');
        $race_data->IS_senior = $request->get('is_senior');
        $race_data->save();
        return view('title');
    }

    public function update_regist_race($race_id){
        $race_data = race_table::where('race_id',$race_id)->first();
        return view('common.update_race_view')->with('race_Item',$race_data);
    }

    public function regist_race_update_data(Request $request){
        $race_data = race_table::where('race_id',$request->get('race_id'))->first();
        $race_data->racename = $request->get('race_name'); 
        $race_data->rank = $request->get('rank');
        $race_data->ground = $request->get('ground');
        $race_data->distance = $request->get('distance');
        $race_data->date = $request->get('date');
        $race_data->is_First = $request->get('is_First');
        $race_data->IS_junior = $request->get('is_junior');
        $race_data->IS_classic = $request->get('is_classic');
        $race_data->IS_senior = $request->get('is_senior');
        $race_data->save();
        return redirect('/umamusume_regist.regist_race_display');
    }

    public function regist_race_display(){
        $races = race_table::orderByRaw('CAST(date as SIGNED) ASC')
        ->orderByRaw('CAST(is_First as SIGNED) DESC')
        ->get();
        return view('common.race_list_view')->with('racelist',$races);
    }

    public function back()
    {
        return view('title');
    }

    //次回出走可能レースの表示
    public function regist_data_race_check($id,string $season = "ジュニア期" ,int $date = 7 , string $isfirst = "前半" ){

        $characterData = character_data::where('id',$id)->first();
        $race_Array = json_decode($characterData->Race_Chack_Field);

        $this->theCurrentSeason = $season;
        $this->theCurrentDate = intval($date);
        $this->theCurrentIsFirst = $isfirst;

        $isArrayIsNull = false;

        do{
            if($isArrayIsNull == true){
                $this->theCurrentSeason = $this->nextSeason;
                $this->theCurrentDate = intval($this->nextDate);
                $this->theCurrentIsFirst = $this->nextIsFirst;
            }
            $searchseason1 = $searchseason2 = "";
            switch($this->theCurrentSeason){
                case "ジュニア期":
                    $searchseason1 = 1;
                    break;
                case "クラシック期" :
                    $searchseason1 = 2;
                    $searchseason2 = 3;
                    break;
                case "シニア期" :
                    $searchseason1 = 3;
                    $searchseason2 = 4;
                    break; 
            }

            foreach($race_Array as $race){
                if($race->出走 == "未" && ($searchseason1 == $race->season || $searchseason2 == $race->season)
                 && $race->出走月 == intval($this->theCurrentDate)  &&  $race->前後半 == $this->theCurrentIsFirst ){
                    $newRaceArray[] = $race; 
                }
            }
            if(empty($newRaceArray)){
                $newRaceArray = null;
            }

        if($this->theCurrentIsFirst == "前半"){
                $this->nextDate = $this->theCurrentDate;
                $this->nextIsFirst = "後半";
        }else{
                $this->nextIsFirst = "前半";
        }

        if(intval($this->theCurrentDate) == 12 && $this->theCurrentIsFirst == "後半"){
                $this->nextDate = 1 ;
                if($this->theCurrentSeason == "ジュニア期"){
                    $this->nextSeason = "クラシック期";
                }else if($this->theCurrentSeason == "クラシック期"){
                    $this->nextSeason = "シニア期";
                }
            }else{
                $this->nextSeason = $this->theCurrentSeason;
            }

            if(intval($this->theCurrentDate) != 12 && $this->theCurrentIsFirst == "後半"){
                $this->nextDate = intval($this->theCurrentDate) + 1;
            }

            if($this->theCurrentSeason == "シニア期" && $this->theCurrentDate == 12 && $this->theCurrentIsFirst == "後半" ){
                $this->nextSeason = "終了";
                $this->nextDate = "終了";
                $this->nextIsFirst = "終了";
                break;
            }

            $isArrayIsNull = true;

        }while($newRaceArray == null);

        return view('common.Character_race_data_regist')
        ->with('now_season',$this->theCurrentSeason)
        ->with('now_date',$this->theCurrentDate)
        ->with('now_is_first',$this->theCurrentIsFirst)
        ->with('Race_Item',$newRaceArray)
        ->with('character',$characterData)
        ->with('Second_season',$this->nextSeason)
        ->with('Second_date',$this->nextDate)
        ->with('Second_is_first',$this->nextIsFirst);
    }

    //戻るボタンの追加
    public function return_regist_data_race_check($id,$season,$date,$isfirst){
        $characterData = character_data::where('id',$id)->first();
        $race_Array = json_decode($characterData->Race_Chack_Field);

        $this->theCurrentSeason = $season;
        $this->theCurrentDate = $date;
        $this->theCurrentIsFirst = $isfirst;

        $isArrayIsNull = false;

        do{
            if($isArrayIsNull == true){
                $this->theCurrentSeason = $this->returnSeason ;
                $this->theCurrentDate = $this->returnDate ;
                $this->theCurrentIsFirst =  $this->returnIsFirst ;
            }

            if($this->theCurrentSeason == "後半" && $this->theCurrentDate > 1){
                $this->nextDate =  $this->theCurrentDate;
                $this->nextIsFirst = $this->theCurrentIsFirst;
                $this->returnIsFirst = "前半";
            }else if($this->theCurrentDate > 1 ){
                $this->returnDate = $this->theCurrentDate - 1;
                $this->nextDate = $this->theCurrentDate;
                $this->returnIsFirst = "前半";
                $this->nextIsFirst = "後半";
            }else if($this->theCurrentDate == 1 && $this->theCurrentIsFirst == "前半"){
                $this->returnDate = $this->theCurrentDate - 1;
                $this->nextDate = $this->theCurrentDate;
                $this->returnIsFirst = "後半";
                $this->nextIsFirst = "前半";
            }
            
            if($this->theCurrentDate == 1 && $this->theCurrentIsFirst == "前半"){
                $this->returnDate = 12 ;
                $this->nextDate = 1 ;
                if($this->theCurrentSeason == "シニア期"){
                    $this->returnSeason = "クラシック期";
                    $this->nextSeason = "シニア期";
                }else if($this->theCurrentSeason == "クラシック期"){
                    $this->returnSeason = "ジュニア期";
                    $this->nextSeason = "クラシック期";
                }
            }else{
                $this->returnSeason = $this->theCurrentSeason;
                $this->nextSeason = $this->theCurrentSeason;
            }

            $searchseason1 = $searchseason2 = "";
            switch($this->returnSeason){
                case "ジュニア期":
                    $searchseason1 = 1;
                    break;
                case "クラシック期" :
                    $searchseason1 = 2;
                    $searchseason2 = 3;
                    break;
                case "シニア期" :
                    $searchseason1 = 3;
                    $searchseason2 = 4;
                    break; 
            }

            foreach($race_Array as $race){
                if($race->出走 == "未" && ($searchseason1 == $race->season || $searchseason2 == $race->season)
                 && $race->出走月 == $this->returnDate  &&  $race->前後半 == $this->returnIsFirst ){
                    $newRaceArray[] = $race; 
                }
            }

            if(empty($newRaceArray)){
                $newRaceArray = null;
            }

            $isArrayIsNull = true;
        }while($newRaceArray == null);

        return view('common.Character_race_data_regist')
        ->with('now_season',$this->returnSeason)
        ->with('now_date',$this->returnDate)
        ->with('now_is_first',$this->returnIsFirst)
        ->with('Race_Item',$newRaceArray)
        ->with('character',$characterData)
        ->with('Second_season',$this->nextSeason)
        ->with('Second_date',$this->nextDate)
        ->with('Second_is_first',$this->nextIsFirst);
    }

    public function race_data_refresh(Request $request){
        $characterData = character_data::where('id',$request->get('character_id'))->first();
        $race_Array = json_decode($characterData->Race_Chack_Field);
        foreach($race_Array as $race){
            if($race->race_id == $request->get('race_Number')){
                $race->出走 = '済';
                break;
            }
        }
        $characterData->Race_Chack_Field = json_encode($race_Array);
        $characterData->save();
        return redirect()->route('umamusume_regist.regist_data_race_check_return',['id' => $request->get("character_id"),'season' => $request->get("season"),'date' => $request->get("date"),'isfirst' => $request->get("is_first")]);
    }

    //レースデータ更新処理
    public function regist_race_refresh(){
        $characterData = character_data::all();
        foreach($characterData as $character){
            $results = null;
            $race_Array = json_decode($character['Race_Chack_Field']);
            for($i = 0 ; $i < count($race_Array) ;$i++){
                $race_data_item = race_table::where('race_id',$race_Array[$i]->race_id)->first();
                $result['race_id'] = $race_data_item->race_id;
                $result["レース名"] = $race_data_item->racename;
                $result["馬塲"] = $race_data_item->ground;
                $result["距離"] = $race_data_item->distance;
                $generation = "";
                if($race_data_item->IS_junior){
                    $generation = "ジュニア期";
                    $result["season"] = 1;
                }else if($race_data_item->IS_classic && $race_data_item->IS_senior){
                    $generation = "クラシック・シニア期";
                    $result["season"] = 3;
                }else if($race_data_item->IS_classic){
                    $generation = "クラシック期";
                    $result["season"] = 2;
                }else{
                    $generation = "シニア期";
                    $result["season"] = 4;
                }
                if($race_data_item->is_First){
                    $result["時期"] =  $generation.":".$race_data_item->date."月前半";
                    $result["前後半"] = "前半";
                }else{
                    $result["時期"] =  $generation.":".$race_data_item->date."月後半";
                    $result["前後半"] = "後半";
                }
                $result["出走時期"] = $generation;
                $result["出走月"] = $race_data_item->date;
                $result["出走"] = $race_Array[$i]->出走;
                $results[] = $result;
                $result = null;
            }
            $character->Race_Chack_Field = json_encode($results);
            $character->save();
        }
        return view('title');
    }
}
