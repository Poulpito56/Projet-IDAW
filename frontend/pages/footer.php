<?php
function change_lang()
{
  if ($_SESSION['lang'] == 'en') {
    return 'fr';
  } else {
    return 'en';
  }
}
?>

<footer>
  <img class="logo-site" src="imgs/logos/i_manger_mieux.png" alt="logo_site">
  <form method="GET" class="lang-form">
    <button type="submit" class="lang-button">
      <input type="hidden" name="lang" value="<?php echo change_lang(); ?>">
      <img class="lang-img" src="imgs/lang/<?php echo change_lang(); ?>.png" alt="traduction">
      <div class="tooltip"><?php echo $tra->language; ?></div>
    </button>
  </form>
</footer>