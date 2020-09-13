<?php
  // HTML文字列をエスケープする
  list($post['title']) = $this->escape($post['title']);
?>
  <article>
    <header class="bl_text_header">
      <time class="bl_text_date" datetime="<?= $post['created_at'] ?>">
        <?= $post['created_at'] ?>
      </time>
    </header>
    <div class="bl_text">
      <h2 class="bl_text_title"><?= $post['title'] ?></h2>
      <?= $post['body'] ?>
    </div>
    <footer class="bl_text_footer">
      <span class="bl_posts_dateago"><?= 'n日前' ?></span>
      <ul class="bl_tags">
      <?php foreach ($post['tags'] as $eachTag): ?>
        <li>
          <a href="">#<?= $eachTag ?></a>
        </li>
      <?php endforeach; ?>
      </ul>
    </footer>
  </article>