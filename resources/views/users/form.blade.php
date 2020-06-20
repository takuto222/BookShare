
@csrf
<div class="form-wrapper">
  <div class="form-group mt-4">
    <label for="formControlTextarea1">自己紹介</label>
    <textarea name="self_intro" required class="form-control" rows="16" placeholder="おすすめの本を紹介しよう">{{ $profile->self_intro ?? old('self_intro') }}</textarea>
  </div>
  <div class="form-group mt-5">
    <label for="formControlTextarea2">私のオススメ</label>
    <textarea name="recommend" required class="form-control" rows="16" placeholder="おすすめの本を紹介しよう">{{ $profile->recommend ?? old('recommend') }}</textarea>
  </div>
  <!-- <div class="form-group mt-5">
    <p>アイコン画像</p>
    <div class="custom-file">
      <input name="file" type="file" class="custom-file-input" id="inputFile">
      <label class="custom-file-label" for="inputFile">ファイルを選択</label>
    </div>
  </div> -->
</div>


<style media="screen">
.form-wrapper * {
  font-size: 125%;
}
</style>
