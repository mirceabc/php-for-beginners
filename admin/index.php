<?php

require '../includes/init.php';

Auth::requireLogin();

$conn = require '../includes/db.php';

$paginator = new Paginator($_GET['page'] ?? 1, 4, Article::getTotal($conn));

$articles = Article::getPage($conn, $paginator->limit, $paginator->offset);

$categories = Category::getAll($conn);

?>
<?php require '../includes/header.php'; ?>

<h2>Administration</h2>

<?php if (empty($articles)): ?>
            <a href="new-article.php">Add new article</a>
            <p>No articles found.</p>
        <?php else: ?>
            <h2>Article</h2><br>
            <a href="new-article.php">Add new article</a>
            <a href="new-category.php">Add new category</a>

            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Published</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($articles as $article): ?>
                        <tr>
                            <td>
                                <a href="article.php?id=<?= $article['id']; ?>">
                                    <?= htmlspecialchars($article['title']); ?>
                                </a>
                            </td>
                            <td>
                                <?php if ($article['published_at']): ?>
                                    <time>
                                        <?= $article['published_at'] ?>
                                    </time>
                                <?php else: ?>
                                    Unpublished

                                    <button class="publish" data-id="<?= $article['id'] ?>">Publish</button>

                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <?php require '../includes/pagination.php';

        endif; ?>

<?php require '../includes/footer.php'; ?>