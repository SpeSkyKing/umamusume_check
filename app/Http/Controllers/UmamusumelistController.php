<?php

namespace App\Http\Controllers;

use App\Models\character_data;
use Illuminate\Http\Request;

class UmamusumelistController extends Controller
{
     /**
     * 画面遷移
     */
    public function display()
    {
        $umamusume_data_row = character_data::get();

        $umamusume_data = null;

        if($umamusume_data_row->count() > 0){
          foreach($umamusume_data_row as $umamusume_Data_item){

              //キャラクターテーブルのレースレコードを取得しオブジェクトへ変更する
              $singleRaceData = json_decode($umamusume_Data_item->Race_Chack_Field);

              //クラマで走るか、ラークで走るかを判定する
              $remainningClimax = array_filter($singleRaceData, function($element){

                  return 
                  /*条件1　ジュニア期以外*/ 
                  ($element->出走時期 != 'ジュニア期') &&
                  /*条件2　7月前半~10月前半までにあるレースか日本ダービーと同じ時期にあるレース*/
                  (($element->出走月 >= 7 && $element->出走月 <= 9) || /* ラークシナリオでの海外遠征タイミング*/
                  ($element->出走月 == 10 && $element->前後半 == "前半") || /* クラシック期・シニア期　10月前半　凱旋門賞*/ 
                  ($element->出走月 == 6 && $element->前後半 == "後半" && $element->出走時期 == 'シニア期') || /* シニア期　6月後半　宝塚記念*/
                  ($element->出走月 == 5 && $element->前後半 == "後半" && $element->出走時期 == 'クラシック期')) && /* クラシック期　5月後半 日本ダービー*/
                  /*日本ダービー、フォワ賞、ニエル賞、凱旋門賞はラークシナリオで走るため除外する*/
                  ($element->レース名 != "日本ダービー") && ($element->レース名 != "フォワ賞") && ($element->レース名 != "ニエル賞") && ($element->レース名 != "凱旋門賞") &&
                  $element->出走 == "未"
                  ;
                });

                if(count($remainningClimax) > 0){
                  $umamusume_Data_item['remainningClimax'] = "1";
                }else{
                  $umamusume_Data_item['remainningClimax'] = "0";
                }

                //各条件で出走していないレースの抽出
                //全体の数
                $checkallRaceRaceList = array_filter($singleRaceData, function($element){

                  return ($element->出走 == '未');
                });
                if($checkallRaceRaceList == null){
                  $umamusume_Data_item['allRaceCount'] = 0;
                }else{
                  $umamusume_Data_item['allRaceCount'] = count($checkallRaceRaceList);
                }

                //芝・長距離
                $checkStayerRaceList = array_filter($singleRaceData, function($element){

                  return 
                  ($element->距離 == '長距離') && ($element->馬塲 == 1) && ($element->出走 == '未');
                });
                if($checkStayerRaceList == null){
                  $umamusume_Data_item['checkStayerRaceCount'] = 0;
                }else{
                  $umamusume_Data_item['checkStayerRaceCount'] = count($checkStayerRaceList);
                }

                //芝・中距離
                $checkGrassClassicRaceList = array_filter($singleRaceData, function($element){

                  return 
                  ($element->距離 == '中距離') && ($element->馬塲 == 1) && ($element->出走 == '未');
                });
                if($checkGrassClassicRaceList == null){
                  $umamusume_Data_item['checkGrassClassicRaceCount'] = 0;
                }else{
                  $umamusume_Data_item['checkGrassClassicRaceCount'] = count($checkGrassClassicRaceList);
                }

                //芝・マイル
                $checkGrassMileRaceList = array_filter($singleRaceData, function($element){

                  return 
                  ($element->距離 == 'マイル') && ($element->馬塲 == 1) && ($element->出走 == '未');
                });
                if($checkGrassMileRaceList == null){
                  $umamusume_Data_item['checkGrassMileRaceCount'] = 0;
                }else{
                  $umamusume_Data_item['checkGrassMileRaceCount'] = count($checkGrassMileRaceList);
                }

                //芝・短距離
                $checkGrassSprintRaceList = array_filter($singleRaceData, function($element){

                  return 
                  ($element->距離 == '短距離') && ($element->馬塲 == 1) && ($element->出走 == '未');
                });
                if($checkGrassSprintRaceList == null){
                  $umamusume_Data_item['checkGrassSprintRaceCount'] = 0;
                }else{
                  $umamusume_Data_item['checkGrassSprintRaceCount'] = count($checkGrassSprintRaceList);
                }

                //ダート・中距離
                $checkDirtClassicRaceList = array_filter($singleRaceData, function($element){

                  return 
                  ($element->距離 == '中距離') && ($element->馬塲 == 0) && ($element->出走 == '未');
                });
                if($checkDirtClassicRaceList == null){
                  $umamusume_Data_item['checkDirtClassicRaceCount'] = 0;
                }else{
                  $umamusume_Data_item['checkDirtClassicRaceCount'] = count($checkDirtClassicRaceList);
                }

                //ダート・マイル
                $checkDirtMileRaceList = array_filter($singleRaceData, function($element){

                  return 
                  ($element->距離 == 'マイル') && ($element->馬塲 == 0) && ($element->出走 == '未');
                });
                if($checkDirtMileRaceList == null){
                  $umamusume_Data_item['checkDirtMileRaceCount'] = 0;
                }else{
                  $umamusume_Data_item['checkDirtMileRaceCount'] = count($checkDirtMileRaceList);
                }

                //ダート・短距離
                $checkDirtSprintRaceList = array_filter($singleRaceData, function($element){

                  return 
                  ($element->距離 == '短距離') && ($element->馬塲 == 0) && ($element->出走 == '未');
                });
                if($checkDirtSprintRaceList == null){
                  $umamusume_Data_item['checkDirtSprintRaceCount'] = 0;
                }else{
                  $umamusume_Data_item['checkDirtSprintRaceCount'] = count($checkDirtSprintRaceList);
                }

                $umamusume_data[] = $umamusume_Data_item;
          }
          $umamusume_data = self::sortByKey('name', SORT_ASC, $umamusume_data);
        }        
        return view('common.Character_data')->with('umamusume_list',$umamusume_data);
    }

    public function back()
    {
        return view('title');
    }
    function sortByKey($key_name, $sort_order, $array) {
      foreach ($array as $key => $value) {
          $standard_key_array[$key] = $value[$key_name];
      }
  
      array_multisort($standard_key_array, $sort_order, $array);
  
      return $array;
  }
  
}
