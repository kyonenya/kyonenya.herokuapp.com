  <ul class="bl_posts">
    <?php foreach ($posts as $post): ?>
    <li class="bl_posts_item" data-id=<?= $post['id']; ?>>
      <header class="bl_posts_header">
        <time class="bl_posts_date" datetime="<?= $post['created_at']; ?>">
          <?= $post['created_at']; ?>
        </time>
        <a href="<?= $baseUrl ?>/posts/edit/<?= $post['id']; ?>">[編集]</a>
        <a href="<?= $baseUrl ?>/posts/delete/<?= $post['id'] ?>">[x]</a>
      </header>
      <a href="<?= $baseUrl ?>/posts/<?= $post['id'] ?>">
        <h2 class="bl_posts_title">
          <?= $post['title']; ?>
        </h2>
        <div class="bl_posts_summary" data-id=${data.length - i}>
          <p><?= $post['body']; ?>…</p>
        </div>
      </a>
      <footer class="bl_posts_footer">
        <span class="bl_posts_dateago"><?= $post['dateago'] ?></span>
        <ul class="bl_tags">
        <?php foreach ($post['tags'] as $eachTag): ?>
          <li>
            <a href="">#<?= $eachTag ?></a>
          </li>  
        <?php endforeach; ?>
        </ul>
      </footer>
    </li>
    <?php endforeach; ?>
    <?php unset($post); ?>
  </ul>