  <h1 class="el_heading1"><?= isset($post) ? '記事編集' : '新規記事作成' ?></h1>
  <form action="<?= $baseUrl ?>/posts/<?= isset($post) ? 'update/' . $post['id'] : 'store' ?>" method="post" class="bl_editor">
    <input type="text" name="title" class="bl_editor_title" placeholder="タイトル" value="<?= $post['title'] ?>" />
    <textarea name="body" class="bl_editor_body" placeholder="本文" ><?= $post['body'] ?></textarea>
    <input type="text" name="tagcsv" class="bl_editor_title" placeholder="#タグ" value="<?= $post['tagcsv'] ?>" />
    <button>投稿</button>
  </form>