@component('components.body')
    @slot('body')
        <form method="post" action="{{route('umamusume_regist.race_data_refresh')}}">
        @csrf
            <div class="race_content">

                <table class="umalist_basic_data" cellspacing="0">
                    <tr>
                        <td class="umalist_basic_data_td">キャラクター名</td>
                        <td class="umalist_basic_data_td_item">{{$character->name}}</td>
                    </tr>
                    <tr>
                        <td class="umalist_basic_data_td">時期</td>
                        <td class="umalist_basic_data_td_item">{{$now_season}}{{$now_date}}月{{$now_is_first}}</td>
                    </tr>
                </table>


               <div class="content">

                    <table class="umalist_date_over" cellspacing="0">
                        <tr>
                            <td class="umalist_date_over_td">
                                <button type="button" class="umamusume_race_button" onclick="location.href='{{ route('umamusume_list.back') }}' ">戻る</button>
                            </td>
                            <td class="umalist_date_over_td">
                            <button type="button" class="umamusume_race_button" onclick="location.href='{{ route('umamusume_regist.return_regist_data_race_check',['id' => $character->id,'season' => $now_season,'date' => $now_date,'isfirst' => $now_is_first]) }}'">前へ</button>
                            </td>
                            <td class="umalist_date_over_td">
                                @if($Second_season != "終了")
                                <button type="button" class="umamusume_race_button" onclick="location.href='{{ route('umamusume_regist.regist_data_race_check_return',['id' => $character->id,'season' => $Second_season,'date' => $Second_date,'isfirst' => $Second_is_first]) }}'">次へ</button>
                                @else
                                <button type="button" class="umamusume_race_button" onclick="location.href='{{ route('umamusume_list.back') }}' ">終了</button>
                                @endif
                            </td>
                        </tr>
                    </table>

                    <table class="umalist_date_Race_Data" cellspacing="0">
                        <tr>
                            <th class="umalist_date_Race_Data_update_th" >出走処理</th>
                            <th class="umalist_date_Race_Data_th_race" >レース名</th>
                            <th class="umalist_date_Race_Data_th" >馬塲</th>
                            <th class="umalist_date_Race_Data_th" >距離</th>
                        </tr>
                        @if($Race_Item != "")
                            @foreach($Race_Item as $Race)
                                <tr>
                                    <td class="umalist_date_Race_Data_update_td">
                                        <button type="submit" class="umamusume_race_button" id="{{$Race->race_id}}" name="race_Number" value="{{$Race->race_id}}">出走</button>
                                        <input name="character_id" type="hidden" value="{{$character->id}}"></input>
                                        <input name="season" type="hidden" value="{{$now_season}}"></input>
                                        <input name="date" type="hidden" value="{{$now_date}}"></input>
                                        <input name="is_first" type="hidden" value="{{$now_is_first}}"></input>
                                    </td>
                                    <td class="umalist_date_Race_Data_td_race" style=@if($Race->馬塲)"background-color:green"> @else"background-color:brown"> @endif{{$Race->レース名}}</td>
                                    <td class="umalist_date_Race_Data_td" style=@if($Race->馬塲)"background-color:green"> 芝 @else"background-color:brown"> ダート @endif</td>
                                    <td class="umalist_date_Race_Data_td" style=
                                    @switch($Race->距離)
                                        @case("長距離")
                                        "background-color:blue"
                                        @break
                                        @case("中距離")
                                        "background-color:Yellow"
                                        @break
                                        @case("マイル")
                                        "background-color:#b8d200"
                                        @break
                                        @case("短距離")
                                        "background-color:pink"
                                        @break
                                    @endswitch
                                    >{{$Race->距離}}</td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
            </div>
        </form>
    </body>
    @endslot
@endcomponent