<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>テスト</title>
    <!--JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
        $(function () {
            $(window).scroll(function () {

                if ($(this).scrollTop() > 240) {
                    $('#nav-scroll').addClass('is-fixed');
                } else {
                    $('#nav-scroll').removeClass('is-fixed');
                }
            });
        });

    </script>
    <style>
        /*スクロールしたら、このCSSを適用し、ナビゲーションバーの位置を固定する*/
        .is-fixed {
            position: fixed;
            top: 4rem;
            left: 0;
            z-index: 1;
            width: 100%;
            height: 4rem;
        }

        .nav-scroller {
          position: relative;
          z-index: 2;
          height: 2.75rem;
          overflow-y: hidden;
        }

        .nav-scroller .nav {
          display: -ms-flexbox;
          display: flex;
          -ms-flex-wrap: nowrap;
          flex-wrap: nowrap;
          padding-bottom: 1rem;
          margin-top: -1px;
          overflow-x: auto;
          color: rgba(255, 255, 255, .75);
          text-align: center;
          white-space: nowrap;
          -webkit-overflow-scrolling: touch;
        }

        .nav-underline .nav-link {
          padding-top: .75rem;
          padding-bottom: .75rem;
          font-size: .875rem;
          color: #6c757d;
        }

        .nav-underline .nav-link:hover {
          color: #007bff;
        }

        .nav-underline .active {
          font-weight: 500;
          color: #343a40;
        }

        /*ナビゲーションバーの大きさを設定 固定スクロールには関係ない*/
        .nav-Wrapper {
            text-align: center;
            background-color: black;
            color: white;
            min-width: 1200px;
            height: 4rem;
        }

        /*div要素を横並びにするcss 固定スクロールには関係ない*/
        .flex {
            display: flex;
        }

    </style>
</head>

<body>
    <!--以下はコンテンツの内容-->
    <div>
        <p>
            ゼロイチはプログラミング、SEO初心者・独学者向けのメディアです。
        </p>
        <p>
            プログラミング言語はRuby Python3が主で
        </p>
        <p>
            フロントエンドはhtml css jquery sassなどの解説記事を投稿しています
        </p>
        <p>
            フロントエンドのjqueryはjavascriptのライブラリで
        </p>
        <p>
            javascriptをシンプルに記載し、拡張機能を利用して容易に動的な動作を実現できます。
        </p>
        <p>
            jQueryは公式サイトからダウンロードする他に、
        </p>
        <p>
            CDNで利用する事もできます。
        </p>
        <!--ナビゲーションメニューを指定ピクセルスクロールするとこの部分が固定-->
        <div class="articles-Wrapper" id="articles-scroll">
            <div class="flex">
                <div>メニュー1</div>
                <duv>メニュー2</duv>
            </div>
        </div>
        <nav class="navbar navbar-expand-md nav-Wrapper navbar-dark bg-dark my-4" id=nav-scroll>
            <div class="nav-scroller bg-white box-shadow">
                <nav class="nav nav-underline">
                    <a class="nav-link active" href="#">ダッシュボード</a>
                    <a class="nav-link" href="#">
                    友達
                    <span class="badge badge-pill bg-light align-text-bottom">27</span>
                    </a>
                    <a class="nav-link" href="#">探検</a>
                    <a class="nav-link" href="#">提案</a>
                    <a class="nav-link" href="#">リンク</a>
                    <a class="nav-link" href="#">リンク</a>
                    <a class="nav-link" href="#">リンク</a>
                    <a class="nav-link" href="#">リンク</a>
                    <a class="nav-link" href="#">リンク</a>
                </nav>
            </div>
        </nav>
        <p>
            GoogleのCDNを使ったjQueryファイルの読み込み方法
        </p>
        <p>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        </p>
        <p>
            MicrosoftのCDNを使ったjQueryファイルの読み込み方法。
        </p>
        <p>
            <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js"></script>
        </p>
        <p>
            jQueryのCDNを使ったjQueryファイルの読み込み方法
        </p>
        <p>
            <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        </p>
        <p>
            下記はGoogleのCDNを利用した場合の例になります。
        </p>
        <p>
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        </p>
        <p>
            この記事ではスクロールしたら
        </p>
        <p>
        途中でナビゲーションバーを固定する方法を
        </p>
        <p>
        解説しています。
        </p>


        <p>
            その他ゼロイチ ではSEOの記事も公開しています。
        </p>
        <p>
           SEOは自分のサイトを検索サイトで上位に表示されるように対策を行うことを言います。
        </p>
        <p>
            例えば、Googleなどでプログラミングと検索したら、自分のサイトが上位に表示される用にするなどです。
        </p>
        <p>
            ただ、プログラミングのキーワードは検索されるボリュームが多いためなかなか上位に表示されません。
        </p>
        <p>
            その為、大きなキーワードで上位を狙うよりは、「プログラミング ruby」 など
        </p>
        <p>
            複数のキーワードで検索された際に上位に表示されるようにすることを目標とした方がよいです。
        </p>
        <p>
            SEO対策には内部対策と外部対策があります。
        </p>
        <p>
           内部対策は自分のサイトをGoogleに解析してもらいやすくする対策で
        </p>
        <p>
            詳細な対策内容は下記URLに記載しています。
        </p>
        <p>
            https://programming-beginner-zeroichi.jp/articles/82
        </p>
        <p>
            外部対策は
        </p>
        <p>
            他のサイトから自身のサイトをリンクを設定してもらう対策です。
        </p>
        <p>
            一般的に外部対策は直ぐには行うことができません。
        </p>
        <p>
            理由はコンテンツの量が少ないサイトは他サイトでも紹介されないためです。
        </p>
        <p>
            即効性はないですが、今直ぐできる外部対策の詳細は下記リンクを御覧ください
        </p>
        <p>
            https://programming-beginner-zeroichi.jp/articles/81
        </p>

    </div>

</body>
</html>