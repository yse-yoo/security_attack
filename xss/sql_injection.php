<?php
require_once "app.php";
if (isset($_POST["email"])) {
    $post = $_POST;
    $user = new User();
    $user->findByEmail($post["email"]);
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include('app/views/components/head.php') ?>

<body>
    <main id="id" class="d-flex justify-content-center">
        <div class="w-50 mt-3 p-5 bg-light">
            <h4>SQL Injection</h4>
            <ul>
                <li>" OR id = "1</li>
            </ul>
            <h2 class="h2 mb-3 fw-normal text-center">Search Email</h2>
            <form action="" method="post">
                <div class="form-floating mb-2">
                    <input id="email" type="text" name="email" value="<?= @$post['email'] ?>" class="form-control">
                    <label for="" class="form-label">Email</label>
                </div>
                <button class="w-100 btn btn-primary">Search</button>
            </form>

            <h3>検索キーワード</h3>
            <?= @$post['email']  ?>

            <h2>結果</h2>
            <?= @$user->value['name']  ?>
        </div>
    </main>
</body>

</html>