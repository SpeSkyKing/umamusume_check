@component('components.body')
    @slot('body')
        <div class="umalist_raceData">
            @csrf
            <table border="1" class="umalist_regist_race" cellspacing="0">
                <tr><th colspan="7" style="background: linear-gradient(45deg,green,brown);">レースリスト</th></tr>
                <tr>
                    <th class="umalist_regist_race_th" style="background: linear-gradient(45deg,green,brown);"></th>
                    <th class="umalist_regist_race_th" style="background: linear-gradient(45deg,green,brown);">バ塲</th>
                    <th class="umalist_regist_race_th" style="background-color:brown;">時期</th>
                    <th class="umalist_regist_race_th" style="background-color:Yellow;">距離</th>
                    <th class="umalist_regist_race_th" style="background-color:orange;">ジュニア</th>
                    <th class="umalist_regist_race_th" style="background-color:purple;">クラシック</th>
                    <th class="umalist_regist_race_th" style="background-color:red;">シニア</th>
                </tr>
                
                @if($racelist->count() > 0)
                    @foreach($racelist as $race)
                    <tr>
                        <td class="umalist_regist_race_td"
                        @switch($race->rank)
                            @case(1)
                                style = "background-color:red;"
                                @break
                            @case(2)
                                style= "background-color:skyblue;"
                                @break  
                            @case(3)
                                style="background-color:yellowgreen;"
                                @break
                        @endswitch><a href='{{route('umamusume_regist.update_regist_race',$race->race_id)}}'>{{$race->racename}}</a></td>
                        <td class="umalist_regist_race_td" style=@if($race->ground)"background-color:00552e;" >芝 @else"background-color:#bc763c;" >ダート @endif</td>
                        <td class="umalist_regist_race_td" style="background-color:silver;">{{$race->date}}月 @if($race->is_First) 前半 @else 後半 @endif</td>
                        <td class="umalist_regist_race_td" style=
                        @switch($race->distance)
                            @case("短距離")
                            "background-color:pink;"
                            @break
                            @case("マイル")
                            "background-color:#b8d200;"
                            @break
                            @case("中距離")
                            "background-color:Yellow;"
                            @break
                            @case("長距離")
                            "background-color:blue;"
                            @break
                        @endswitch
                            >{{$race->distance}}</th>
                        <td class="umalist_regist_race_td" style=@if($race->IS_junior)"background-color:red;color:"> ◯ @else "background-color:blue;">× @endif</td>
                        <td class="umalist_regist_race_td" style=@if($race->IS_classic)"background-color:red;"> ◯ @else "background-color:blue;">× @endif</td>
                        <td class="umalist_regist_race_td" style=@if($race->IS_senior)"background-color:red;"> ◯ @else "background-color:blue;">× @endif</td>
                    </tr>
                    @endforeach    
                @endif
            </table>
            <div>
                <button type="button" onclick="location.href='{{ route('umamusume_list.back') }}' ">戻る</button>
            </div>
        </div>
        @endslot
@endcomponent