$(function () {
    var initLikeState = Boolean($('.initial-is-liked-by').text()),        // いいねボタンの初期状態
    initBookmarkState = Boolean($('.initial-is-bookmarked-by').text()),   // ブックマークボタンの初期状態
    initCountLikes = $('.initial-count-likes').text(),                    // いいね数の初期状態
    likeIcon = $('#like-icon'),
    bookmarkIcon = $('#bookmark-icon'),
    icon,                                                                 // 押下されたアイコン
    duration = 300,                                                       // アニメーション時間
    countLikes = $('#count-likes'),                                       // いいね数の表示先
    authorized = Boolean($('.authorized').text()),                        // ログイン状態
    url,                                                                  // 送信先
    reqType;                                                              // HTTPメソッドの種類

    // 初期状態のアイコン状態の設定
    if (initLikeState) {
        likeIcon.toggleClass('active');
    }

    if (initBookmarkState) {
        bookmarkIcon.toggleClass('active');
    }

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
        }
    });

    $('#like, #bookmark').click(function(event) {
        event.preventDefault();
        icon = $(this).children('i');
        url = $(this).attr('href');

        // 状態の読み取り
        if (icon.hasClass('active')) {
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
            // いいね,ブックマークの表示変更
            icon.toggleClass('active');
            console.log(data.id);
            // いいね数の表示変更
            if (icon.attr('id') == 'like-icon') {
              countLikes.text(data.countLikes);
            }

        })
        // 通信に失敗した際の処理
        .fail(function(jqXHR, textStatus, errorThrown) {
            console.log("失敗");
            console.log("エラー：" + textStatus);
            console.log("テキスト：" + jqXHR.responseText);
        })
    });

});
