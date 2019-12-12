@extends('layouts.app')

@section('content')
  <div class="uk-container">
    <div class="uk-card uk-card-default uk-width-3-5@s uk-align-center">
      <div class="uk-card-body">
        <h1>グラフ</h1>
        <hr>
        <div style="margin: 40px 30px ;">
          <p>それぞれの価値観についてどれくらい日記を書いたかを記録します。</p>
          <p>グラフ上にカーソルを乗せると日記数が表示されます。</p>
          <p>各価値観のラベルをクリックするとその価値観のグラフ内の表示をON/OFFできます。</p>
        </div>
        <canvas id="myChart">ご覧の環境では、canvas要素がサポートされていないようです。</canvas>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <!-- chart.jsの読み込み -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

  <script>
    (function() {
      'use strict';

      /**
       * 以下、円グラフ描画のための記述
       */

      // postsテーブルとvalueテーブルをそれぞれJSで受け取る
      let post_list = JSON.parse('<?php echo json_encode($posts); ?>');
      let value_list = JSON.parse('<?php echo json_encode($values); ?>');

      // 各日記内で選択された価値観を配列にまとめる
      let value_tags_in_posts = [];
      for (let i = 0; i < post_list.length; i++) {
        value_tags_in_posts.push(post_list[i].value_tags);
      }

      /**
       * 価値観一覧用の配列を用意
        最終的には
        value_names = ['思いやり','自立','勇気'];
        のような形にする
       */
      let value_names = [];

      /**
       * それぞれの価値観について書かれた日記の合計数を価値観ごとに配列にまとめる
        最終的には
        sum_list = [6, 9, 5];
        のような形にする
       */
      // 
      let sum = 0;
      let sum_list = [];
      for (let i = 0; i < value_list.length; i++) {
        value_names.push(value_list[i].value);
        
        for (let j = 0; j < post_list.length; j++) {
          if (post_list[j].value_tags.indexOf(value_names[i]) > -1) {
            sum += 1;
          }
        }
        sum_list.push(sum);
        sum = 0;
      }

      let ctx = document.getElementById('myChart').getContext('2d');
      let type = 'pie';
      let data = {
        labels: value_names,
        datasets: [{
          backgroundColor: [
            //価値観は12個が上限なので12色を用意
            "#7b9ad0",
            "#f8e352",
            "#c8d627",
            "#d5848b",
            "#e5ab47",
            "#e1cea3",
            "#51a1a2",
            "#b1d7e4",
            "#66b7ec",
            "#c08e47",
            "#ae8dbc",
            "#c3cfa9",
          ],
          data: sum_list,
        }]
      };

      let myChart = new Chart(ctx, {
        type: type,
        data: data,
      });
    })();
  </script>
@endsection