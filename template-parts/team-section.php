<?php
/**
 * Sponsors / Team Members Section Template
 * Output team members grid and modal.
 * Usage: get_template_part('template-parts/sponsors-section');
 * Theme: amt-spice
 */
if ( ! defined( 'ABSPATH' ) ) exit;

// Query Team Members
$args = array(
    'post_type'      => 'team_member',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order title',
    'order'          => 'ASC',
);
$team_query = new WP_Query($args);
$team_members = $team_query->have_posts();
?>

<section class="team-section">
    <div class="container">
        <h2 class="section-title text-start"><?php esc_html_e('Our Team', 'amt-spice'); ?></h2>
        <p class="intro-text"><?php esc_html_e('Explore Our Success Stories and Innovative Projects', 'amt-spice'); ?></p>
        <p class="intro-text"><?php esc_html_e('Meet the Team page is a tab on a company\'s website devoted to introducing a company\'s employees to customers. This webpage also allows visitors to learn more about executives managing a company, which can establish credibility and promote transparency. Customers may prefer supporting a company that prioritizes availability and accountability.', 'amt-spice'); ?></p>

        <div class="team-row">
            <?php if ( $team_members ) : $idx = 1; ?>
                <?php while ( $team_query->have_posts() ) : $team_query->the_post();
                    $position = get_post_meta( get_the_ID(), '_team_member_position', true );
                    $img_url = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
                    $img_url = $img_url ?: 'https://via.placeholder.com/100x200?text=No+Image';
                    $socials = get_post_meta( get_the_ID(), '_team_member_socials', true );
                    ?>
                    <div class="team-member" data-member="<?php echo esc_attr($idx); ?>">
                        <img src="<?php echo esc_url($img_url); ?>" alt="<?php the_title_attribute(); ?>" class="team-img">
                        <div class="team-overlay">
                            <div class="vertical-text"><strong><?php the_title(); ?></strong><br><?php echo esc_html($position); ?></div>
                        </div>
                        <div class="team-data" style="display:none"
                             data-name="<?php echo esc_attr(get_the_title()); ?>"
                             data-position="<?php echo esc_attr($position); ?>"
                             data-img="<?php echo esc_url($img_url); ?>"
                             data-desc="<?php echo esc_attr(get_the_content()); ?>"
                             data-socials='<?php echo json_encode($socials); ?>'>
                        </div>
                    </div>
                    <?php $idx++; endwhile; wp_reset_postdata(); ?>
            <?php else: ?>
                <p><?php esc_html_e('No team members added yet.', 'amt-spice'); ?></p>
            <?php endif; ?>
        </div>

        <div id="team-description-container" class="team-description-container" style="display:flex;">
            <div id="desc-img" class="description-img">
                <div class="placeholder-text"><?php esc_html_e('Team photo will appear here', 'amt-spice'); ?></div>
            </div>
            <div class="description-text">
                <h4 id="desc-name"><?php esc_html_e('Team Member Name', 'amt-spice'); ?></h4>
                <span class="position" id="desc-position"><?php esc_html_e('Position Title', 'amt-spice'); ?></span>
                <p id="desc-text"><?php esc_html_e('Hover over any team member to view their details.', 'amt-spice'); ?></p>
                <div class="social-links" id="social-links"></div>
            </div>
        </div>
    </div>
</section>

<script>
    function getSocialIconClass(key) {
        const icons = {
            twitter: "fab fa-twitter",
            facebook: "fab fa-facebook-f",
            linkedin: "fab fa-linkedin-in",
            instagram: "fab fa-instagram",
            github: "fab fa-github",
            dribbble: "fab fa-dribbble",
            behance: "fab fa-behance",
            youtube: "fab fa-youtube"
        };
        return icons[key] || "";
    }

    document.addEventListener("DOMContentLoaded", function(){
        const members = document.querySelectorAll('.team-member');
        const descImg = document.getElementById('desc-img');
        const descName = document.getElementById('desc-name');
        const descPosition = document.getElementById('desc-position');
        const descText = document.getElementById('desc-text');
        const socialLinks = document.getElementById('social-links');
        let currentTimeout = null;

        members.forEach(function(member){
            member.addEventListener('mouseenter', function(){
                if (currentTimeout) clearTimeout(currentTimeout);

                const data = member.querySelector('.team-data');
                const name = data.getAttribute('data-name');
                const position = data.getAttribute('data-position');
                const img = data.getAttribute('data-img');
                const desc = data.getAttribute('data-desc');
                let socials = {};
                try {
                    socials = JSON.parse(data.getAttribute('data-socials'));
                } catch(e){ socials = {}; }

                descImg.innerHTML = '<img src="'+img+'" alt="'+name+'" style="width:100%;height:100%;object-fit:cover;border-radius:5px;">';
                descName.textContent = name;
                descPosition.textContent = position;
                descText.textContent = desc;

                socialLinks.innerHTML = '';
                if(socials && typeof socials === 'object'){
                    Object.keys(socials).forEach(function(key){
                        const url = socials[key];
                        if(url){
                            socialLinks.innerHTML +=
                                '<a href="'+url+'" class="'+key+'" target="_blank">'+
                                '<i class="'+getSocialIconClass(key)+'"></i>'+
                                '</a>';
                        }
                    });
                }
            });
        });

        document.querySelector('.team-row').addEventListener('mouseleave', function() {
            currentTimeout = setTimeout(function() {
                descImg.innerHTML = '<div class="placeholder-text"><?php esc_html_e('Team photo will appear here', 'amt-spice'); ?></div>';
                descName.textContent = "<?php esc_html_e('Team Member Name', 'amt-spice'); ?>";
                descPosition.textContent = "<?php esc_html_e('Position Title', 'amt-spice'); ?>";
                descText.textContent = "<?php esc_html_e('Hover over any team member to view their details.', 'amt-spice'); ?>";
                socialLinks.innerHTML = "";
            }, 300);
        });

        document.getElementById('team-description-container').addEventListener('mouseenter', function() {
            if (currentTimeout) clearTimeout(currentTimeout);
        });
    });
</script>
<style>
    .team-section {
      padding: 80px 0;
      background-color: #f4f8f9;
    }
    .section-title {
      margin-bottom: 60px;
      text-align: center;
      font-weight: 700;
      
      

  font-size: 2.8rem;
  color: #009bbe;
  margin-bottom: 30px;
  position: relative;
  z-index: 1;
}
.section-title::after {
  content: '';
  display: block;
  width: 80px;
  height: 5px;
  background: #fd153a;
  margin-top: 15px;
}
    .intro-text {
      text-align: center;
      margin-bottom: 50px;
      font-size: 1.2rem;
      color: #6c757d;
      max-width: 700px;
      margin-left: 0px;
      margin-right: auto;
    }
    .team-row {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 40px;
      margin-bottom: 40px;
    }
    .team-member {
      position: relative;
      width: 100px;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    .team-member:hover {
      transform: scale(1.1);
    }
    .team-img {
      width: 100px;
      height: 200px;
      object-fit: cover;
      border-radius: 40px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.2);
      transition: all 0.3s ease;
    }
    .team-member:hover .team-img {
      box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }
    .team-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.7);
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0;
      transition: all 0.3s ease;
      border-radius: 40px;
    }
    .team-member:hover .team-overlay {
      opacity: 1;
    }
    .vertical-text {
      color: white;
      writing-mode: vertical-rl;
      text-orientation: mixed;
      transform: rotate(180deg);
      font-size: 0.9rem;
      text-align: center;
      line-height: 1.6;
      letter-spacing: 1px;
    }
    .team-description-container {
      display: flex;
      background: white;
      border-radius: 10px;
      padding: 25px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      margin-top: 30px;
      animation: fadeIn 0.3s ease;
      flex-wrap: wrap;
      gap: 20px;
    }
    .description-img {
      width: 150px;
      height: 200px;
      object-fit: cover;
      border-radius: 5px;
      background-color: #f8f9fa;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #6c757d;
      font-size: 0.9rem;
      text-align: center;
    }
    .description-text {
      flex: 1;
      min-width: 250px;
    }
    .description-text h4 {
      color: #2c3e50;
      margin-bottom: 10px;
      font-weight: 600;
    }
    .description-text .position {
      color: #6c757d;
      font-style: italic;
      margin-bottom: 15px;
      display: block;
    }
    .description-text p {
      color: #6c757d;
      margin-bottom: 20px;
    }
    .social-links {
      display: flex;
      gap: 15px;
      margin-top: 15px;
    }
    .social-links a {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background-color: #f0f0f0;
      color: #2c3e50;
      transition: all 0.3s ease;
      text-decoration: none;
      font-size: 1rem;
    }
    .social-links a:hover {
      transform: scale(1.1);
      color: white;
    }
    .social-links a.twitter:hover { background-color: #1DA1F2; }
    .social-links a.facebook:hover { background-color: #4267B2; }
    .social-links a.linkedin:hover { background-color: #0077B5; }
    .social-links a.instagram:hover { 
      background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
    }
    .social-links a.github:hover { background-color: #333; }
    .social-links a.dribbble:hover { background-color: #EA4C89; }
    .social-links a.behance:hover { background-color: #1769FF; }
    .social-links a.youtube:hover { background-color: #FF0000; }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .placeholder-text {
      padding: 20px;
      text-align: center;
    }
  </style>