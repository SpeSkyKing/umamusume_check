@component('components.body')
    @slot('body')
        <div class="registbody">
            <form method="post" action="{{route('umamusume_regist.regist_race_data')}}">
                @csrf
                @php
                    $race_rank_select = array(["number" => "1","rank" => "GⅠ"],["number" => "2","rank" => "GⅡ"],["number" => "3","rank" => "GⅢ"]);
                    $dates = ["1","2","3","4","5","6","7","8","9","10","11","12"];
                    $race_distance = ["短距離","マイル","中距離","長距離"];
                @endphp
                <table border="1" class="regist">
                    <tr class="uammusume_datafields">
                        <th colspan="2" class="data_register">レースデータ登録</th>
                    </tr>
                    <tr class="uammusume_datafields">
                        <th><label><span>レース名</span></label></th>
                        <th><input name="race_name"></input></th>
                    </tr>

                    <tr class="uammusume_datafields">
                        <th><label><span>レースのランク</span></label></th>
                        <th>
                            <select name="rank">
                                @foreach($race_rank_select as $race_rank)
                                    <option value="{{$race_rank['number']}}" class="Suitability">{{$race_rank['rank']}}</option> 
                                @endforeach
                            </select>   
                        </th>
                    </tr>

                    <tr class="uammusume_datafields">
                        <th><label><span>馬塲</span></label></th>
                        <th>
                            <select name="ground">
                                <option value="1" class="Suitability">芝</option>
                                <option value="0" class="Suitability">ダート</option> 
                            </select>   
                        </th>
                    </tr>

                    <tr class="uammusume_datafields">
                        <th><label><span>距離</span></label></th>
                        <th>
                            <select name="distance">
                                @foreach($race_distance as $race)
                                    <option value="{{$race}}" class="Suitability">{{$race}}</option> 
                                @endforeach
                            </select>   
                        </th>
                    </tr>

                    <tr class="uammusume_datafields">
                        <th><label><span>出走月</span></label></th>
                        <th>
                            <select name="date">
                                @foreach($dates as $date)
                                    <option value="{{$date}}" class="Suitability">{{$date}}月</option> 
                                @endforeach
                            </select>   
                        </th>
                    </tr>

                    <tr class="uammusume_datafields">
                        <th><label><span>前後半</span></label></th>
                        <th>
                            <select name="is_First">
                                <option value="1" class="Suitability">前半</option>
                                <option value="0" class="Suitability">後半</option> 
                            </select>   
                        </th>
                    </tr>

                    <tr class="uammusume_datafields">
                        <th><label><span>ジュニア</span></label></th>
                        <th>
                            <select name="is_junior">
                                <option value="1" class="Suitability">◯</option>
                                <option value="0" class="Suitability">×</option> 
                            </select>   
                        </th>
                    </tr>

                    <tr class="uammusume_datafields">
                        <th><label><span>クラシック</span></label></th>
                        <th>
                            <select name="is_classic">
                                <option value="1" class="Suitability">◯</option>
                                <option value="0" class="Suitability">×</option> 
                            </select>   
                        </th>
                    </tr>

                    <tr class="uammusume_datafields">
                        <th><label><span>シニア</span></label></th>
                        <th>
                            <select name="is_senior">
                                <option value="1" class="Suitability">◯</option>
                                <option value="0" class="Suitability">×</option> 
                            </select>   
                        </th>
                    </tr>
                    </tr>
                        <th colspan="2"><input type="submit" id="regist_Umamusume" style="width:75%"/></th>
                    </tr>
                    <tr>
                        <th colspan="2"><button type="button" onclick="location.href='{{ route('umamusume_regist.back') }}' " style="width:75%">戻る</button></th>
                    </tr>    
                </table>
            </form>
        </div>
        @endslot
@endcomponent