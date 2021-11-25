</div>
<!-- JQuery could be eliminated without too much effort. Mostly for getting the upload results. -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<!-- Bootstrap bundle include Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!-- our JavaScript -->
<script type="text/javascript" src="<?php echo SITE_URL; ?>js/application.js"></script>
<?php if (function_exists('customPageFooter')){
          customPageFooter();
      }?>
</body>
</html>