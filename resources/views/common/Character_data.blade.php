@component('components.body')
    @slot('body')
        <div>
            @csrf
            <table border="1" cellspacing="0" class="umalist">
                <tr>
                    <th class="umalist_th_name" style="background-color:black;"></th>
                    <th class="umalist_th" style="background-color:brown;" colspan="2">馬塲適正</th>
                    <th class="umalist_th_distance" colspan="4">距離適正</th>
                    <th class="umalist_th_leg_quality" colspan="4">脚質適正</th>
                    <th class="umalist_th_leg_Scenario" style="background-color:green;">推奨</th>
                    <th class="umalist_th_Race_Counter" >総 155</th>
                    <th class="umalist_th_grass" colspan="4">芝</th>
                    <th class="umalist_th_dirt" colspan="3">ダート</th>
                </tr>
                <tr>
                    <th class="umalist_th_name" style="background-color:gray;">名前</th>
                    <th class="umalist_th" style="background-color:green;"  name="suitability" value="Grass_Suitability"            ><a href='{{ route('umamusume_list.regist_data_sort') }}'>芝</a></th>
                    <th class="umalist_th" style="background-color:brown;"  name="suitability" value="Dirt_Suitability"             ><a href='{{ route('umamusume_list.regist_data_sort') }}'>ダート</a></th>
                    <th class="umalist_th" style="background-color:pink;"   name="suitability" value="Sprint_Suitability"           ><a href='{{ route('umamusume_list.regist_data_sort') }}'>短距離</a></th>
                    <th class="umalist_th" style="background-color:#b8d200;"name="suitability" value="Mile_Suitability"             ><a href='{{ route('umamusume_list.regist_data_sort') }}'>マイル</a></th>
                    <th class="umalist_th" style="background-color:Yellow;" name="suitability" value="Classic_Suitability"          ><a href='{{ route('umamusume_list.regist_data_sort') }}'>中距離</a></th>
                    <th class="umalist_th" style="background-color:blue;"   name="suitability" value="Stayer_Suitability"           ><a href='{{ route('umamusume_list.regist_data_sort') }}'>長距離</a></th>
                    <th class="umalist_th" style="background-color:#00885a;"name="suitability" value="Lead_Pace_Suitability"        ><a href='{{ route('umamusume_list.regist_data_sort') }}'>逃げ</a></th>
                    <th class="umalist_th" style="background-color:white;"  name="suitability" value="Front_Runner_Suitability"     ><a href='{{ route('umamusume_list.regist_data_sort') }}'>先行</a></th>
                    <th class="umalist_th" style="background-color:purple;" name="suitability" value="Hold_Up_Runner_Suitability"   ><a href='{{ route('umamusume_list.regist_data_sort') }}'>差し</a></th>
                    <th class="umalist_th" style="background-color:red;"    name="suitability" value="Late_Charge_Drive_Suitability"><a href='{{ route('umamusume_list.regist_data_sort') }}'>追込</a></th>
                    <th class="umalist_th" style="background-color:green;"  >シナリオ</th>
                    <th class="umalist_th_Race_Counter" name="suitability"  >残レース</th>
                    <th class="umalist_th" style="background-color:blue;"   >長距離</th>
                    <th class="umalist_th" style="background-color:Yellow;" >中距離</th>
                    <th class="umalist_th" style="background-color:#b8d200;">マイル</th>
                    <th class="umalist_th" style="background-color:pink;"   >短距離</th>
                    <th class="umalist_th" style="background-color:Yellow;" >中距離</th>
                    <th class="umalist_th" style="background-color:#b8d200;">マイル</th>
                    <th class="umalist_th" style="background-color:pink;"   >短距離</th>
                </tr>
                @if($umamusume_list != null && count($umamusume_list) > 0)
                    @foreach($umamusume_list as $umamusume)
                    <tr>
                        <td class="umalist_td_name"
                        @if($umamusume->allRaceCount == 0)
                        style="background-color:red;"><a>{{$umamusume->name}} 全冠</a> 
                        @else
                        style="background-color:skyblue;"><a href='{{ route('umamusume_regist.regist_data_race_check',$umamusume->id) }}'>{{$umamusume->name}}</a>
                        @endif
                        </th>
                        <td class="umalist_td" style="background-color:green;">{{$umamusume->Grass_Suitability}}</td>
                        <td class="umalist_td" style="background-color:brown;">{{$umamusume->Dirt_Suitability}}</td>
                        <td class="umalist_td" style="background-color:pink;">{{$umamusume->Sprint_Suitability}}</td>
                        <td class="umalist_td" style="background-color:#b8d200;">{{$umamusume->Mile_Suitability}}</td>
                        <td class="umalist_td" style="background-color:Yellow;">{{$umamusume->Classic_Suitability}}</td>
                        <td class="umalist_td" style="background-color:blue;">{{$umamusume->Stayer_Suitability}}</td>
                        <td class="umalist_td" style="background-color:#00885a;">{{$umamusume->Lead_Pace_Suitability}}</td>
                        <td class="umalist_td" style="background-color:white;">{{$umamusume->Front_Runner_Suitability}}</td>
                        <td class="umalist_td" style="background-color:purple;">{{$umamusume->Hold_Up_Runner_Suitability}}</td>
                        <td class="umalist_td" style="background-color:red;">{{$umamusume->Late_Charge_Drive_Suitability}}</td>
                        <td class=
                            @if($umamusume->remainningClimax == "0" && $umamusume->allRaceCount == 0)
                            "umalist_td" style="background-color:gold;"> 全冠 
                            @elseif($umamusume->remainningClimax == "0")
                            "umalist_td_larc">Larc
                            @else
                            "umalist_td" style="background-color:green;"> CLI 
                            @endif</td>
                        <td class=@if($umamusume->allRaceCount > 0)"umalist_td_grassordirt">{{$umamusume->allRaceCount}}@else"umalist_td" style="background-color:gold;">全冠@endif</td>
                        <td class="umalist_td_grass" style="background-color:green;">{{$umamusume->checkStayerRaceCount}}</td>
                        <td class="umalist_td_grass" style="background-color:green;">{{$umamusume->checkGrassClassicRaceCount}}</td>
                        <td class="umalist_td_grass" style="background-color:green;">{{$umamusume->checkGrassMileRaceCount}}</td>
                        <td class="umalist_td_grass" style="background-color:green;">{{$umamusume->checkGrassSprintRaceCount}}</td>
                        <td class="umalist_td_dirt" style="background-color:brown;">{{$umamusume->checkDirtClassicRaceCount}}</td>
                        <td class="umalist_td_dirt" style="background-color:brown;">{{$umamusume->checkDirtMileRaceCount}}</td>
                        <td class="umalist_td_dirt" style="background-color:brown;">{{$umamusume->checkDirtSprintRaceCount}}</td>
                    </tr>
                    @endforeach    
                @endif
            </table>
            <div>
                <button class="umalist_return" type="button" onclick="location.href='{{ route('umamusume_list.back') }}' ">戻る</button>
            </div>
        </div>
    @endslot
@endcomponent