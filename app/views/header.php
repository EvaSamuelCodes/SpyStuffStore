
<!-- cart button -->
<nav>
    <div class="stageleft">  <a href="/">SpyStuffStore</a></div>
    <div class="stageright">
        <a href='/ecart/display' class='button'>Cart (<?= $_SESSION['total_items'] ?>)
        </a>
    </div>
</nav>
<!--/ cart button -->
<?= $this->show_status_messages(); ?>
