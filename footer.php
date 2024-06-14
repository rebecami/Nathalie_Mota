    </div>
    <?php get_template_part('templates_part/modal'); ?>
        <footer>
            <?php 
            wp_nav_menu([
                'theme_location' => 'footer',
                'container' => false,
                'menu_class' => 'footer-menu',
            ]) 
            ?> 
        </footer>    
    
        <?php wp_footer() ?>             
          
    </body>
</html>