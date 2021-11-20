</main>
<!-- Bootstrap bundle include Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!-- our JavaScript -->
<script type="text/javascript" src="<?php echo SITE_URL; ?>js/application.js"></script>
<?php if (function_exists('customPageFooter')){
          customPageFooter();
      }?>
</body>
</html>