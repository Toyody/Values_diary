@extends('layouts.app')

@section('content')
  <div class="uk-container">
    <div class="uk-card uk-card-default uk-width-3-5@s uk-align-center">
      <div class="uk-card-body">
        <h1 class="uk-text-center">価値観日記へようこそ！</h1>
        <hr>
        <div class="uk-child-width-1-2@m" uk-grid>
            <div>
              <p class="uk-text-bold uk-text-center uk-margin-medium-top">初めての方はこちらのページから</p>
              <a href="{{ route('about') }}" ><button class="uk-button uk-button-default uk-align-center"><span class="uk-icon uk-margin-small-right" uk-icon="info"></span>価値観日記とは</button></a>
            </div>
            <img src="/storage/images/writing-1209121_1280.jpg" alt="writing">
        </div>
      </div>
    </div>
  </div>
@endsection

@section('css')
  <style>
    /* スマホとPC環境時にフッター下に出てくる余白対策。タブレット時は余白がない */
    @media screen and (max-width: 559px), screen and (min-width: 960px) {
      html{
        height:100%; 
      }

      body{
        height:100%;
      }
    }
  </style>
@endsection