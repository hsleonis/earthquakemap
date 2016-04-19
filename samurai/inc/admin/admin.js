(function($) {
    // Define the tour!
    var tour;

    $(window).load(function() {
        // Start the tour!

    });
    $(document).ready(function() {
        $('#tutorial').on('click', function() {

            tour = {
                id: "hello-hopscotch",
                steps: [{
                    title: "Backend Editor が選択されてることをご確認下さい。",
                    content: "もしこのボタンが'Classic Mode' になっていれば、OKです。",
                    target: $('.wpb_switch-to-composer')[0],
                    placement: "right",
                    arrowOffset: 'center',
                    yOffset: 'center',
                }, {
                    title: "要素の追加",
                    content: 'プラスアイコンをクリック<br><div class="instruction" style=" background-image:url(' + admin_src + 'img/add.png)"></div>または、こちらをクリックか<div class="instruction" style=" background-image:url(' + admin_src + 'img/add1.png)"></div>こちらをクリック<div class="instruction" style=" background-image:url(' + admin_src + 'img/add2.png)"></div>',
                    target: $('#vc_navbar .vc_show-mobile')[0],
                    placement: "right",
                    arrowOffset: 'center',
                    yOffset: 'center',
                    showPrevButton:true,
                }, {
                    title: "CSS クラス及びIDの追加",
                    content: '鉛筆アイコンをクリック(ポップアップウインドウが開きます)<br>ポップアップウインドウをスクロールダウンすると、ID, クラスのテキスト入力フィールドがあります。<div class="instruction" style=" background-image:url(' + admin_src + 'img/class_id.png)"></div>',
                    target: $('.wpb_sortable .vc_controls-row .vc_column-edit')[1],
                    placement: "right",
                    arrowOffset: 'center',
                    yOffset: 'center',
                    showPrevButton:true,
                }, {
                    title: "要素の編集",
                    content: 'カーソルを要素の中に重ねると緑色の鉛筆アイコンが表示されます。それをクリック。<div class="instruction" style=" background-image:url(' + admin_src + 'img/edit.png)"></div>',
                    target: document.querySelector(".wpb_special_heading"),
                    placement: "top",
                    arrowOffset: 'center',
                    xOffset: 'center',
                    showPrevButton:true,
                }, {
                    title: "カラムの編集",
                    content: 'カーソルをcustomに重ねると、 カラム数を選択できます。<div class="instruction" style=" background-image:url(' + admin_src + 'img/row.png)"></div>',
                    target: $('.vc_row_layouts')[1],
                    placement: "right",
                    arrowOffset: 'center',
                    yOffset: 'center',
                    showPrevButton:true,
                }]
            };

            hopscotch.startTour(tour);
        });
    });



})(jQuery);