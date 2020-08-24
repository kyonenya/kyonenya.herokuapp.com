<!DOCTYPE html>
<html lang="ja">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
  <meta charset="UTF-8" />
  <title><?= $title ? $title . '｜' : '' ?>placet experiri</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- CSSインポート -->
  <link href="css/reset.css" media="all" rel="stylesheet" type="text/css" />
  <link href="css/style.css" media="all" rel="stylesheet" type="text/css" />
  <!-- JavaScriptライブラリをCDNからインポート -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script><!-- Moment.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/ja.js"></script><!-- Moment.js 日本語ロケール -->
  <!-- JavaScript、ページ生成スクリプト -->
  <script src="main.js"></script>
  <!-- アイコン画像 -->
  <link rel="apple-touch-icon" type="image/png" sizes="180x180" href="icon/apple-touch-icon-180x180.png" />
  <link rel="icon" type="image/png" sizes="192x192" href="icon/icon-192x192.png" />
  <link rel="icon" href="favicon.ico" />
  <!-- 通常のメタデータ -->
  <meta name="description" content="言ってみただけ。哲学と哲学以外のことを書くテキストサイト" />
  <!-- SNS用のメタデータ -->
  <meta property="og:site_name" content="placet experiri" />
  <meta property="og:locale" content="ja_JP" />
  <meta property='og:type' content='article' />
  <meta property='og:title' content='placet experiri' />
  <meta property='og:url' content='https://kyonenya.github.io/' />
  <meta property='og:description' content="言ってみただけ。哲学と哲学以外のこと" />
  <meta property="og:image" content="https://kyonenya.github.io/icon/ogp-image.png" />
  <meta name="twitter:card" content="summary" />
  <!-- Google Search Console -->
  <meta name="google-site-verification" content="Egnv9xjpahwkf_HbmCbOzspRSkyNl9h276nl6BngEiA" />
</head>
<body>
<header class="ly_header">
  <div class="ly_header_inner">
    <h1>
      <a href="<?= $baseUrl ?>/" class="el_logo">placet experiri</a>
      <span class="el_logo_suffix"><?= $post['id'] ? ' :: ' . $post['id'] : '' ?></span>
    </h1>
    <nav class="bl_nav">
      <ul class="bl_nav_inner">
        <li><a href="<?= $baseUrl ?>/">Home</a></li>
        <li><a href="<?= $baseUrl ?>/works">Works</a></li>
        <li><a href="<?= $baseUrl ?>/about">About</a></li>
        <li class="el_search">
          <img src="img/search.svg" class="el_search_icon" alt="検索アイコン" />
          <form>
            <input type="search" placeholder="検索ワードを入力" value="" class="el_search_form">
          </form>
        </li>
      </ul>
    </nav>
  </div>
  <!-- /.ly_header_inner -->
</header>
<main>
  <section class="ly_cont">
<?= $html ?>
  </section>
  <!-- /.ly_cont -->
</main>
<footer class="ly_footer">
  <div class="ly_footer_inner">
    <p class="el_footerCopyright">&copy; 2020- <a href="<?= $baseUrl ?>/about">placet experiri</a></p>
  </div>
</footer>
</body>
</html>