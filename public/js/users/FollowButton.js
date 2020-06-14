$(function () {

    var initFollowState = Boolean($('.initial-is-followed-by').text()),       // フォローボタンの初期状態
        followBtn = $('#follow-button'),
        followIcon = $('#follow-icon'),
        followState = $('#follow-state'),
        countFollowings = $('#count-followings'),
        countFollowers = $('#count-followers'),
        authorized = Boolean($('.authorized').text()),                        // ログイン状態
        url,                                                                  // 送信先
        reqType;                                                              // HTTPメソッドの種類

    // 初期状態のアイコン状態の設定
    if (initFollowState) {
      followBtn.toggleClass('active');
      followIcon.removeClass("fa-user-plus");
      followIcon.addClass("fa-user-check");
      followState.text('フォロー中');
    } else {
      followIcon.removeClass("fa-user-check");
      followIcon.addClass("fa-user-plus");
      followState.text('フォロー');
    }

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
      }
    });

    followBtn.click(function(event) {
        event.preventDefault();
        if(authorized) {
            url = $(this).attr('href');
            // 状態の読み取り
            if (followBtn.hasClass('active')) {
              reqType = 'DELETE';
            } else {
              reqType = 'PUT';
            }
            $.ajax({
              dataType: "json",
              type: reqType,
              url: url,
            })
            // 通信に成功した際の処理
            .done(function(data, status) {
                // フォローボタン、アイコンの表示変更
                followBtn.toggleClass('active');
                followIcon.toggleClass('fa-user-plus');
                followIcon.toggleClass('fa-user-check');
                if(followState.text() === 'フォロー中') {
                  followState.text('フォロー');
                } else {
                  followState.text('フォロー中');
                }

                // フォロー数、フォロワー数の表示変更
                countFollowings.text(data.countFollowings + 'フォロー');
                countFollowers.text(data.countFollowers + 'フォロワー');
            })
            // 通信に失敗した際の処理
            .fail(function(jqXHR, textStatus, errorThrown) {
                console.log("失敗");
                console.log("エラー：" + textStatus);
                console.log("テキスト：" + jqXHR.responseText);
            })
        }
    });

  // ------------------- モーダルウィンドウの表示 ------------------
    followBtn.on('click', function(event) {
      event.preventDefault();
      $('#modal').modal();
    });

});
