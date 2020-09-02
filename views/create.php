  <h1 class="el_heading1">新規記事作成</h1>
  <form action="<?= $baseUrl ?>/posts/store" method="post" class="bl_editor">
    <input type="text" name="title" class="bl_editor_title" placeholder="タイトル" value="タイトル"/>
    <textarea name="body" class="bl_editor_body" placeholder="本文" >本文</textarea>
    <input type="text" name="taglist" class="bl_editor_title" placeholder="#タグ" value="タグ" />
    <button>投稿</button>
  </form>