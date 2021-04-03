<?php
$page_title = 'Encyption';
require('includes/site_header.php');

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    $_SESSION['state_msg'] = 'You don\'t have access to the requested page';
    header("Location: index.php");
}

$result = '';
$key = base64_decode($config['encryption']['key']);
$plaintext = "a puddle waking up one morning and thinking, 'This is an interesting world I find myself in — an interesting hole I find myself in — fits me rather neatly, doesn't it? In fact it fits me staggeringly well, must have been made to have me in it!' This is such a powerful idea that as the sun rises in the sky and the air heats up and as, gradually, the puddle gets smaller and smaller, frantically hanging on to the notion that everything's going to be alright, because this world was meant to have him in it, was built to have him in it; so the moment he disappears catches him rather by surprise.";

if (isset($_POST['input'])) {
    if (isset($_POST['encrypt'])) {
        // $result = encrypt($key,$_POST['input']);
    } elseif (isset($_POST['decrypt'])) {
        // $result=decrypt($key,$_POST['input']);
    }
}

?>
<h2 class="my-5 text-center">Enter text to encrypt or decrypt</h2>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    <div class="d-flex justify-content-center">
        <textarea name="input" id="input" cols="80" rows="10">
        <?= htmlspecialchars($result) ?>
        </textarea>
    </div>
    <div class="d-flex justify-content-center">
        <input type="submit" name="decrypt" value="DECRYPT" class="btn btn-warning">
        <input type="submit" name="encrypt" value="ENCRYPT" class="btn btn-success">
    </div>
</form>

<?php
require('includes/site_footer.php');
