    </div>
        <footer>
            <?php 
            wp_nav_menu([
                'theme_location' => 'footer',
                'container' => false,
                'menu_class' => 'footer-menu',
            ]) 
            ?>    
        <?php wp_footer() ?>             
        </footer>   
    </body>
</html>