<footer>

  <div class="footer clearfix mb-0 text-muted">

    <div class="float-start">

      <p><?= date('Y'); ?> &copy; <a href="<?= SITE_URL ?>"> <?= SITE_NAME; ?></a></p>

    </div>

    <div class="float-end">

      <p>Developed By <a href="https://mithun.info.bd/">Mithun

          Chandra Sutradhar</a>

      </p>

    </div>

  </div>

</footer>

</div>

<!-- Modal -->

<div class="modal fade" id="ajaxModal" tabindex="-1" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content"></div>

  </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="./assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>

<script src="./assets/js/bootstrap.bundle.min.js"></script>


<script src="./assets/js/jquery.magnific-popup.min.js"></script>



<script src="./assets/js/main.js"></script>



<form method="post" action="" id="logout" class="d-none">

  <input type="hidden" name="logout">

</form>

<script>
$(function() {

  setTimeout(function() {

    $(".removeAlert").slideUp(500, function() {

      $(this).remove();

    });

  }, 3000);

});



function logout() {

  sessionStorage.clear();

  $('#logout').submit();

}
</script>

</body>



</html>