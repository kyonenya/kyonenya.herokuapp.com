  <h1 class="el_heading1">新規記事作成</h1>
  <form action="<?= $baseUrl ?>/posts/store" method="post">
    <input type="text" name="title" />
    <textarea name="body" cols="80" rows="20"></textarea>
    <button>投稿</button>
  </form>