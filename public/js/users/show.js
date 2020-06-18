$(function () {

    // ----------------------------------------------------
    //      いいね、ブックマークした記事の表示切り替え
    // ----------------------------------------------------
    $('.item-selection').on('change', function(event) {
          $('#like-articles-wrapper').toggleClass("hidden");
          $('#bookmark-articles-wrapper').toggleClass("hidden");
    });


    // ----------------------------------------------------
    //              ページネーション機能
    // ----------------------------------------------------
    var $items = [$('.shelf-item'), $('.post-item'), $('.reviews-item')], //表示アイテム
    $containers = [$('#shelf_container'), $('#post_container'), $('#reviews_container')], // 表示先
    $paginationList = [$('#shelf-pagination'), $('#post-pagination'), $('#reviews-pagination')] // 各ページのページネーション
    maxPageNumList = [0, 0, 0],             // 最大ページ数
    startItemIndexList = [0, 0, 0],         // 表示アイテムの開始インデックス
    endItemIndexList = [0, 0, 0],           // 表示アイテムの終了インデックス
    perPageList = [9, 9, 9];                // １ページあたりの表示アイテム数

    // 初期化処理
    $.each($items, function(index, $item) {
        // 一度アイテムを削除して、表示し直す
        $item.remove();
        showItems($containers[index], $item, startItemIndexList[index], perPageList[index]);
        // ページネーションを使って、アイテムを表示
        maxPageNumList[index] = Math.ceil($item.length / perPageList[index]);
        drawPagination($paginationList[index], 1, maxPageNumList[index], perPageList[index], $items[index], $containers[index]);
    });

    function drawPagination($pagination, pageNum, maxPageNum, perPage, $item, $container) {
      // 一度更にする
      $pagination.twbsPagination('destroy');
      console.log($pagination);
      console.log(pageNum);
      console.log(maxPageNum);
      console.log(perPage);
      console.log($container);

      // ページネーションを描画する
      $pagination.twbsPagination({
          startPage : pageNum,
          // totalPages: maxPageNum,
           totalPages: 3, // reviewsがないためにエラーが出るので仮固定
          first: '最初',
          prev : '前',
          next : '次',
          last : '最後',
          // onPageClick の関数が初期表示時に実行されないようにする
          initiateStartPageClick: false,
          onPageClick: function (event, pageNum) {
              // 前のページ要素の削除
              $item.remove();
              // 押されたページの読み込み
              startItemIndex = perPage * (pageNum - 1);
              endItemIndex = perPage * pageNum;
              showItems($container, $item, startItemIndex, endItemIndex);
          },
      });
    }

    function showItems($container, $item, start, end) {
      for (var i = start; i < end; i++) {
        $container.append($item[i]);
      }
    }

});
