@component('components.body')
    @slot('body')
        <div class="registbody">
            <form method="post" action="{{route('umamusume_regist.regist_race_update_data')}}">
                @csrf
                @php
                    $race_rank_select = array(["number" => "1","rank" => "GⅠ"],["number" => "2","rank" => "GⅡ"],["number" => "3","rank" => "GⅢ"]);
                    $dates = ["1","2","3","4","5","6","7","8","9","10","11","12"];
                    $race_distance = ["短距離","マイル","中距離","長距離"];
                @endphp
                <table border="1" class="regist">
                    <tr class="uammusume_datafields">
                        <th colspan="2" class="data_register">レースデータ更新</th>
                    </tr>
                    <tr class="uammusume_datafields">
                        <th><label><span>レース名</span></label></th>
                        <th><input name="race_name" value="{{$race_Item->racename}}"></input></th>
                    </tr>

                    <tr class="uammusume_datafields">
                        <th><label><span>レースのランク</span></label></th>
                        <th>
                            <select name="rank">
                                @foreach($race_rank_select as $race_rank)
                                    <option value="{{$race_rank['number']}}" class="Suitability" @selected($race_Item->rank == $race_rank['number'])>{{$race_rank['rank']}}</option> 
                                @endforeach
                            </select>   
                        </th>
                    </tr>

                    <tr class="uammusume_datafields">
                        <th><label><span>馬塲</span></label></th>
                        <th>
                            <select name="ground">
                                <option value="1" class="Suitability"@selected($race_Item->ground)>芝</option>
                                <option value="0" class="Suitability"@selected(!$race_Item->ground)>ダート</option> 
                            </select>   
                        </th>
                    </tr>

                    <tr class="uammusume_datafields">
                        <th><label><span>距離</span></label></th>
                        <th>
                            <select name="distance">
                                @foreach($race_distance as $race)
                                    <option value="{{$race}}" class="Suitability"@selected($race_Item->distance == $race)>{{$race}}</option> 
                                @endforeach
                            </select>   
                        </th>
                    </tr>

                    <tr class="uammusume_datafields">
                        <th><label><span>出走月</span></label></th>
                        <th>
                            <select name="date">
                                @foreach($dates as $date)
                                    <option value="{{$date}}" class="Suitability"@selected($race_Item->date == $date)>{{$date}}月</option> 
                                @endforeach
                            </select>   
                        </th>
                    </tr>

                    <tr class="uammusume_datafields">
                        <th><label><span>前後半</span></label></th>
                        <th>
                            <select name="is_First">
                                <option value="1" class="Suitability"@selected($race_Item->is_First)>前半</option>
                                <option value="0" class="Suitability"@selected(!$race_Item->is_First)>後半</option> 
                            </select>   
                        </th>
                    </tr>

                    <tr class="uammusume_datafields">
                        <th><label><span>ジュニア</span></label></th>
                        <th>
                            <select name="is_junior">
                                <option value="1" class="Suitability"@selected($race_Item->IS_junior)>◯</option>
                                <option value="0" class="Suitability"@selected(!$race_Item->IS_junior)>×</option> 
                            </select>   
                        </th>
                    </tr>

                    <tr class="uammusume_datafields">
                        <th><label><span>クラシック</span></label></th>
                        <th>
                            <select name="is_classic">
                                <option value="1" class="Suitability"@selected($race_Item->IS_classic)>◯</option>
                                <option value="0" class="Suitability"@selected(!$race_Item->IS_classic)>×</option> 
                            </select>   
                        </th>
                    </tr>

                    <tr class="uammusume_datafields">
                        <th><label><span>シニア</span></label></th>
                        <th>
                            <select name="is_senior">
                                <option value="1" class="Suitability"@selected($race_Item->IS_senior)>◯</option>
                                <option value="0" class="Suitability"@selected(!$race_Item->IS_senior)>×</option> 
                            </select>   
                        </th>
                    </tr>
                    </tr>
                        <th colspan="2">
                            <input type="submit" id="regist_Umamusume" style="width:75%" value="更新"/>
                            <input type="hidden" id="regist_Umamusume" name="race_id" value="{{$race_Item->race_id}}"/> 
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2"><button type="button" onclick="location.href='{{ route('umamusume_regist.regist_race_display') }}' " style="width:75%">戻る</button></th>
                    </tr>    
                </table>
            </form>
        </div>
        @endslot
@endcomponent