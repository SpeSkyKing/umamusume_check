@component('components.body')
    @slot('body')
    <div class="umalist_title">
        @csrf
            <table>
                <tr>
                    <th>
                        <p style="font-size:20px;">データ管理ツール</p>    
                    </th>
                <tr>

                <tr>
                    <th class="umalist_toppage">
                        <button type="button" class="welcome-body_button-class" onclick="location.href='{{ route('umamusume_regist.display') }}' ">キャラクターデータ入力</button>
                    </th>
                </tr>
                <tr>
                    <th class="umalist_toppage">
                        <button type="button" class="welcome-body_button-class" onclick="location.href='{{ route('umamusume_list.display') }}' ">キャラクターデータ確認</button>
                    </th>
                </tr>

                <tr>
                    <th class="umalist_toppage">
                        <button type="button" class="welcome-body_button-class" onclick="location.href='{{ route('umamusume_regist.regist_race') }}' ">出走レース追加</button>
                    </th>
                </tr>

                <tr>
                    <th class="umalist_toppage">
                        <button type="button" class="welcome-body_button-class" onclick="location.href='{{ route('umamusume_regist.regist_race_display') }}' ">設定済みレース表示</button>
                    </th>
                </tr>
                
                <tr>
                    <th class="umalist_toppage">
                        <button type="button" class="welcome-body_button-class" onclick="location.href='{{ route('umamusume_regist.regist_race_refresh') }}' ">レースデータ更新処理実行</button>
                    </th>
                </tr>

            </table>
        </div>
    @endslot
@endcomponent