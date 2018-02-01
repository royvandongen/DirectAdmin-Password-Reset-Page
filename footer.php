<?php

require_once('config.inc.php');

?>

        </main>

        <footer class="footer">
            <div class="container">
                <!--<p class="float-right" >
                    <a href="#">Back to top</a>
                </p>-->
                <p><a href="<?php ECHO ORG_DOMAIN; ?>" class="footer-link"><?php echo ORG_NAME; ?></a> <?php echo ORG_FOOTER; ?>
                - Password-Reset by <a href="https://www.github.com/royvandongen">Roy van Dongen</a>&copy;</p>
            </div>
        </footer>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/password_reset.js"></script>
    </body>
</html>
