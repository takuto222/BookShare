$(function () {
  //
  //        ドラッグ＆ドロップ機能
  //
  var fileArea = document.getElementById('dragDropArea');
  var fileInput = document.getElementById('fileInput');
  fileArea.addEventListener('dragover', function(evt){
    evt.preventDefault();
    fileArea.classList.add('dragover');
  });
  fileArea.addEventListener('dragleave', function(evt){
      evt.preventDefault();
      fileArea.classList.remove('dragover');
  });
  fileArea.addEventListener('drop', function(evt){
      evt.preventDefault();
      fileArea.classList.remove('dragenter');
      var files = evt.dataTransfer.files;
      fileInput.files = files;
      console.log(files[0]);
      photoPreview('onChenge',files[0]);
  });

  function photoPreview(event, f = null) {
    var file = f;
    if(file === null){
        file = event.target.files[0];
    }
    var reader = new FileReader();
    var preview = document.getElementById("previewArea");
    var previewImage = document.getElementById("previewImage");

    if(previewImage != null) {
      preview.removeChild(previewImage);
    }
    reader.onload = function(event) {
      var img = document.createElement("img");
      img.setAttribute("src", reader.result);
      img.setAttribute("id", "previewImage");
      preview.appendChild(img);
    };

    reader.readAsDataURL(file);
  }


  //
  //              書籍検索機能
  //
  var $container = $('#search-results'),  // 検索結果の表示先コンテナ
  elements = [],                          // 出力アイテム格納先
  perPage = 5,                            // １ページあたりの表示アイテム数
  maxPageNum = 0,                         // 最大ページ数
  maxResults = 30,                        // 検索件数
  startItemIndex = 0,                     // 表示アイテムの開始インデックス
  endItemIndex = perPage;                 // 表示アイテムの終了インデックス

  var itemInfo = {
    title: [],                            // タイトル
    author: [],                           // 著者
    publishedDate: [],                    // 出版日
    averageRating: [],                    // 評点
    thumbnail: [],                        // 本の画像
    caption: [],                          // キャプション
    price: []                             // 価格
  };

  // ［検索］ボタンクリックで書籍検索を実行
  $('#search').click(function(event) {
    event.preventDefault();
    $.getJSON('https://www.googleapis.com/books/v1/volumes?callback=?',
      {
        q: $('#query-words').val(),
        maxResults: maxResults,
      }
    )
    // 結果の取得に成功した際の処理
    .done(function(data, status) {
      $container.empty();
      elements = [];
      $.each(data.items, function (index, item) {
        try {
          itemInfo.title[index] = (item.volumeInfo.title);
          itemInfo.author[index] = (item.volumeInfo.authors[0]);
          itemInfo.publishedDate[index] = (item.volumeInfo.publishedDate);
          itemInfo.averageRating[index] = (item.volumeInfo.averageRating);
          itemInfo.caption[index] = (item.volumeInfo.description);
          itemInfo.thumbnail[index] = (item.volumeInfo.imageLinks.thumbnail);
          itemInfo.price[index] = (item.volumeInfo.saleInfo.amount);
        } catch(e) {
          itemInfo.thumbnail.push("https://placehold.it/200x200");
        }
        var itemHTML = '<li class="item" id="' + `${index}` + '">' +
                        '<a class="item-selecter" href="#">' +
                        '<img class="item-img" src="' + itemInfo.thumbnail[index] +
                        '" alt="' + itemInfo.title[index] +'">' +
                        '<h5 class="item-title">' + itemInfo.title[index] + '</h5>' +
                        '<p>' + itemInfo.author[index] + '</p>' +
                        '</a>' +
                        '</li>'
        elements.push($(itemHTML).get(0));
      });
      // ページネーションを使って、アイテムを表示
      maxPageNum = Math.ceil(data.totalItems / perPage);
      drawPagination(1, maxPageNum);
      showItems(elements, startItemIndex, endItemIndex);
    });
  });

  function drawPagination(pageNum, maxPageNum) {
    // 一度更にする
    $('#pagination').twbsPagination('destroy');
    // ページネーションを描画する
    $('#pagination').twbsPagination({
        startPage : pageNum,
        totalPages: maxPageNum,
        first: '最初',
        prev : '前',
        next : '次',
        last : '最後',
        // onPageClick の関数が初期表示時に実行されないようにする
        initiateStartPageClick: false,
        onPageClick: function (event, pageNum) {
            // 前のページ要素の削除
            $('.item').remove();
            // 押されたページの読み込み
            startItemIndex = perPage * (pageNum - 1);
            endItemIndex = perPage * pageNum;
            showItems(elements, startItemIndex, endItemIndex);
        },
    });
  }

  function showItems(elements, start, end) {
    for (var i = start; i < end; i++) {
      $container.append(elements[i]);
    }
  }

  // アイテムが選択されたときの処理
  $container.on('click', 'a', function(event){
    event.preventDefault();
    var itemIndex = $(this).parent().attr('id');
    $("#title").val(itemInfo.title[itemIndex]);
    $("#author").val(itemInfo.author[itemIndex]);
    $("#publication_date").val(itemInfo.publishedDate[itemIndex]);
    $("#price").val(itemInfo.price[itemIndex]);
    $("#score").val(itemInfo.averageRating[itemIndex]);
    $("#caption").val(itemInfo.caption[itemIndex]);

    var preview = $("#previewArea").get(0);
    $("#previewArea").empty();
    var img = document.createElement("img");
    img.setAttribute("src", itemInfo.thumbnail[itemIndex]);
    img.setAttribute("id", "previewImage");
    preview.appendChild(img);
  });

  $('.basic-info')


});
