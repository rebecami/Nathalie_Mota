<?php get_header() ?>

<!-- HERO -->
<div class="hero">
    <h1 class="site_title"> Photographe event</h1>
        <?php
        $query_hero = new WP_Query([
            'post_type' => 'photo',        
            'posts_per_page' => 1,
            'orderby'=> 'rand',
            'tax_query' =>[
                [
                    'taxonomy' => 'format',
                    'field' => 'slug',
                    'terms' => 'paysage'
                ]
            ]
        ]);
            while($query_hero->have_posts()){ 
                $query_hero->the_post();?>
                    <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                    
            <?php
            } 
        ?>    
</div>

<div class="filters">
    <div class="taxonomy_filter">
        <?php
        $category = strip_tags(get_the_term_list($post->ID, 'categorie'));
        $categories = get_terms(array(
            'taxonomy' => 'categorie',
            'hide_empty' => false,
            'terms' => $category
        )); 
        ?>
        <select name="categorie" id="categorie"> 
            <option value="" disabled selected>Catégories</option>
            <?php   
                foreach($categories as $categorie){
                    if($categorie->slug !== 'categorie'){ ?>
                        <option value="<?php echo esc_attr($categorie->slug); ?>">
                            <?php echo esc_html($categorie->name); ?>
                        </option><?php
                    }
                } 
            ?>
        </select>
    
        <?php 
        $formats =get_terms(array(
            'taxonomy' => 'format'
        ));
        ?>
        <select name="format" id="format">
            <option value="" disabled selected>Formats</option>
            <?php 
                foreach($formats as $format)
                if($format->slug !== 'format'){ ?>
                    <option value="<?php echo esc_attr($format->slug); ?>">
                        <?php echo esc_html($format->name); ?>
                    </option><?php
                }
            ?>
        </select>
    </div>
    <div class="date_filter">
        <select name="date" id="date">
            <option value="" disabled selected>Trier par</option>
            <option value="DESC">Plus récent</option>
            <option value="ASC">Plus ancien</option>
        </select>
    </div>
</div>

<div class="home_gallery">
   
</div>

<div class="btn__wrapper">
  <button class="btn__primary" id="load-more">Charger plus</button>
</div> 
<hr/>

<?php get_footer() ?>