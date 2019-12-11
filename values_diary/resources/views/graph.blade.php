@extends('layouts.app')

@section('content')
  <div class="uk-container">
    <div class="uk-card uk-card-default uk-width-3-5@s uk-align-center">
      <div class="uk-card-body">
        <h3>グラフ</h3>
        <canvas id="myChart1">ご覧の環境では、canvas要素がサポートされていないようです。</canvas>
        <canvas id="myChart2">ご覧の環境では、canvas要素がサポートされていないようです。</canvas>
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

      let post_list = JSON.parse('<?php echo json_encode($posts); ?>');
      let value_list = JSON.parse('<?php echo json_encode($values); ?>');

      let value_name = [];
      for (let i = 0; i < value_list.length; i++) {
        value_name.push(value_list[i].value);
      }
      console.log(value_name); // 価値観名一覧

      let value_tags_in_posts = [];
      for (let i = 0; i < post_list.length; i++) {
        value_tags_in_posts.push(post_list[i].value_tags);
      }
      console.log(value_tags_in_posts); // 日記にある価値観名一覧（重複あり）

      let date_of_posts = [];
      for (let i = 0; i < post_list.length; i++) {
        console.log(post_list[i].created_at);
        // let year = post_list[i].created_at.getFullYear();
        // let month = post_list[i].created_at.getMonth() + 1;
        // date_of_posts.push(year + '年' + month + '月');
      }
      console.log(date_of_posts); // 日記の日付一覧


      console.log(post_list.length); //日記数
      console.log(value_list.length); //価値観数

      console.log(post_list[0].actions_for_value); // 0番目の日記のactionsカラム

      console.log(post_list); //ユーザーの日記データ
      console.log(value_list); //ユーザーの価値観データ

      // 価値観ごとの日記の割合（円グラフ）pie doughnut
      // 月間の日記数推移（折れ線グラフ）line
      // 月間の価値観別積み上げ推移（横棒グラフhorizontalBar）
      let ctx1 = document.getElementById('myChart1').getContext('2d');

      let type1 = 'line';

      let data1 = {
        labels: date_of_posts,
        datasets: [{
          label: '@taguchi',
          data: [120, 300, 200, 210],
          borderColor: 'red',
          borderWidth: 5,
          fill: false,
          pointStyle: 'rect',
        }]
      };

      let options1;

      let myChart1 = new Chart(ctx1, {
        type: type1,
        data: data1,
        options: options1,
      });



      let ctx2 = document.getElementById('myChart2').getContext('2d');

      let type2 = 'line';
      // bar 棒グラフ
      // line 折れ線グラフ(fillで塗りつぶし調整可)
      // radar レーダーチャート
      let data2 = {
        labels: [2010, 2011, 2012, 2013],
        datasets: [{
          label: '@taguchi',
          data: [120, 300, 200, 210],
          borderColor: 'red',
          borderWidth: 5,
          fill: false,
          pointStyle: 'rect',
        },{
          label: '@fkoji',
          data: [100, 200, 250, 230],
          borderColor: 'blue',
          borderWidth: 5,
          backgroundColor: 'rgba(0, 0, 255, 0.3)',
          lineTension: 0, // 緩やかな曲線では無く直線にする
          pointStyle: 'triangle',
        }]
      };
      let options2 = {
        scales: {
          yAxes: [{
            ticks: {
              suggestedMin: 0,
              suggestedMax: 400,
              stepSize: 100,
              callback: function(value, index, values) {
                return 'JPY' + value;
              }
            }
          }]
        },
        title: {
          display: true,
          text: 'Annual Sales',
          fontSize: 18,
          position: 'left',
        },
        animation: {
          duration: 10,
        },
        legend: {
          // position: 'right',
          // display: false,
        }
      };

      let myChart2 = new Chart(ctx2, {
        type: type2,
        data: data2,
        options: options2,
      });
    })();
  </script>
@endsection