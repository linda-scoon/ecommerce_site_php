<?php
$page_title = 'Encyption';
require('includes/site_header.php');

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    $_SESSION['state_msg'] = 'You don\'t have access to the requested page';
    header("Location: index.php");
}

$result = '';
$key = base64_decode($config['encryption']['key']);

if (isset($_POST['input'])) {
    if (isset($_POST['encrypt'])) {
        $encoder = new encryption($key, null);
        $result = $encoder->encrypt($_POST['input']);
    } elseif (isset($_POST['decrypt'])) {
        $encoder = new encryption($key, $_POST['input']);
        //stoping errors from displaying and checking if encryption fails then display failure message
        if(!(@$result = $encoder->decrypt())){
            $result = 'Encryption failed. Invalid cipher';
        }
    }
}
?>
<h2 class="my-5 text-center">Enter text to encrypt or decrypt</h2>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    <div class="d-flex justify-content-center">
        <textarea name="input" id="input" cols="30" rows="10"><?= htmlspecialchars($result) ?></textarea>
    </div>
    <div class="d-flex justify-content-center">
        <input type="submit" name="decrypt" value="DECRYPT" class="btn btn-warning m-2">
        <input type="submit" name="encrypt" value="ENCRYPT" class="btn btn-success m-2">
    </div>
</form>

<?php
require('includes/site_footer.php');
