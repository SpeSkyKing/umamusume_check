@component('components.body')
    @slot('body')
        <div class="registbody">
            <form method="post" action="{{route('umamusume_regist.regist')}}">
                @csrf
                @php
                    $suitability_select = ["A","B","C","D","E","F","G"];
                @endphp
                <table border="1" cellspacing="0" class="umalist_regist_table" cellpadding="5">
                    <tr class="umalist_regist_table_tr">
                        <th colspan="2" class="data_register">適正データ登録</td>
                    </tr>
                    <tr class="umalist_regist_table_tr">
                        <td class="umalist_regist_table_td">
                            <label>
                                <span>名前</span>
                            </label>
                        </td>
                        <td class="umalist_regist_table_td">
                            <input name="Uma_name"></input>
                        </td>
                    </tr>

                    <tr class="umalist_regist_table_tr">
                        <td class="umalist_regist_table_td">
                            <label>
                                <span>芝</span>
                            </label>
                        </td>
                        <td class="umalist_regist_table_td">
                            <select name="grass">
                                @foreach($suitability_select as $suitability)
                                    <option value="{{$suitability}}" class="Suitability">{{$suitability}}</option> 
                                @endforeach
                            </select>   
                        </td>
                    </tr>
                    <tr class="umalist_regist_table_tr">
                        <td class="umalist_regist_table_td">
                            <label>
                                <span>ダート</span>
                            </label>
                        </td>
                        <td class="umalist_regist_table_td">
                            <select name="dirt">
                                @foreach($suitability_select as $suitability)
                                    <option value="{{$suitability}}" class="Suitability">{{$suitability}}</option> 
                                @endforeach
                            </select>   
                        </td>
                    </tr>
                    <tr class="umalist_regist_table_tr">
                        <td class="umalist_regist_table_td">
                            <label>
                                <span>長距離</span>
                            </label>
                        </td>
                        <td class="umalist_regist_table_td">
                            <select name="stayer">
                                @foreach($suitability_select as $suitability)
                                    <option value="{{$suitability}}" class="Suitability">{{$suitability}}</option> 
                                @endforeach
                            </select>   
                        </td>
                    </tr>
                    <tr class="umalist_regist_table_tr">
                        <td class="umalist_regist_table_td">
                            <label>
                                <span>中距離</span>
                            </label>
                        </td>
                        <td class="umalist_regist_table_td">
                            <select name="classic">
                                @foreach($suitability_select as $suitability)
                                    <option value="{{$suitability}}" class="Suitability">{{$suitability}}</option> 
                                @endforeach
                            </select>   
                        </td>
                    </tr>
                    <tr class="umalist_regist_table_tr">
                        <td class="umalist_regist_table_td">
                            <label>
                                <span>マイル</span>
                            </label>
                        </td>
                        <td class="umalist_regist_table_td" >
                            <select name="mile">
                                @foreach($suitability_select as $suitability)
                                    <option value="{{$suitability}}" class="Suitability">{{$suitability}}</option> 
                                @endforeach
                            </select>   
                        </td>
                    </tr>
                    <tr class="umalist_regist_table_tr">
                        <td class="umalist_regist_table_td">
                            <label>
                                <span>短距離</span>
                            </label>
                        </td>
                        <td class="umalist_regist_table_td">
                            <select name="sprint">
                                @foreach($suitability_select as $suitability)
                                    <option value="{{$suitability}}" class="Suitability">{{$suitability}}</option> 
                                @endforeach
                            </select>   
                        </td>
                    </tr>
                    <tr class="umalist_regist_table_tr">
                        <td class="umalist_regist_table_td">
                            <label>
                                <span>逃げ<span>
                            </label>
                        </td>
                        <td class="umalist_regist_table_td">
                            <select name="lead_pece">
                                @foreach($suitability_select as $suitability)
                                    <option value="{{$suitability}}" class="Suitability">{{$suitability}}</option> 
                                @endforeach
                            </select>   
                        </td>
                    </tr>
                    <tr class="umalist_regist_table_tr">
                        <td class="umalist_regist_table_td">
                            <label>
                                <span>先行</span>
                            </label>
                        </td>
                        <td class="umalist_regist_table_td">
                            <select name="front_runner">
                                @foreach($suitability_select as $suitability)
                                    <option value="{{$suitability}}" class="Suitability">{{$suitability}}</option> 
                                @endforeach
                            </select>   
                        </td>
                    </tr>
                    <tr class="umalist_regist_table_tr">
                        <td class="umalist_regist_table_td">
                            <label>
                                <span>差し</span>
                            </label>
                        </td>
                        <td class="umalist_regist_table_td">
                            <select name="hold_up_runner">
                                @foreach($suitability_select as $suitability)
                                    <option value="{{$suitability}}" class="Suitability">{{$suitability}}</option> 
                                @endforeach
                            </select>   
                        </td>
                    </tr>
                    <tr class="umalist_regist_table_tr">
                        <td class="umalist_regist_table_td">
                            <label>
                                <span>追込</span>
                            </label>
                        </td>
                        <td class="umalist_regist_table_td">
                            <select name="late_charge_runner">
                                @foreach($suitability_select as $suitability)
                                    <option value="{{$suitability}}" class="Suitability">{{$suitability}}</option> 
                                @endforeach
                            </select>   
                        </td>
                    </tr>
                    </tr>
                        <td class="umalist_regist_table_td" colspan="2">
                            <input type="submit" id="regist_Umamusume" style="width:75%"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="umalist_regist_table_td" colspan="2">
                            <button type="button" onclick="location.href='{{ route('umamusume_regist.back') }}' " style="width:75%">戻る</button>
                        </td>
                    </tr>    
                </table>
            </form>
        </div>
        @endslot
@endcomponent