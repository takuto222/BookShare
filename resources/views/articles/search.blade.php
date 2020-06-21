@extends('app')

@section('title', '検索結果一覧')


<div class="search-results">
  @include('articles.article_list')
</div>

<style media="screen">
.search-results {
  width: 970px;
  margin: 10px auto;
}
</style>
