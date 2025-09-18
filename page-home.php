<?php

get_header();

// calculage age for quip joke
$julian_dob = new DateTime('1998-05-07');
$today = new DateTime('now');
$julian_age = $today->diff($julian_dob);
$julian_age_years = $julian_age->y;

// get all projects posts with WP Query
$projects_args = [
  'post_type' => 'projects',
  'posts_per_page' => -1,
  'orderby' => 'menu_order',
  'order' => 'ASC',
];
$projects_query = new WP_Query($projects_args);

// get work history from theme options
$work_history = get_field('work_history', 'option');
?>

<header class="header">

  <button class="header__idcta idcta" id="idcta-btn">
    <img class="idcta__icon" src="<?php echo get_template_directory_uri(); ?>/assets/icons/id.svg" alt="ID card icon">
  </button>

  <div class="header__inner">
    <div class="my-card header__my-card">
      <div class="my-card__main">
        <div class="my-card__pfp pfp">

          <div class="pfp__bubble">
            <blockquote class="pfp__bubble-blockquote"><em>Responsive</em>, huh? 😉</blockquote>
          </div>

          <div class="pfp__quip-container">
            <!-- fat photo quip -->
            <div class="pfp__quip pfp__quip--one">
              <img class="pfp__quip-arrow" src="<?php echo get_template_directory_uri(); ?>/assets/images/drawn-arrow-right-md.svg" alt="Handrawn arrow pointing at Julian's profile picture">
              <p class="pfp__quip-text">
                uses and old photo
                <br>
                because he got fat
              </p>
            </div>

            <!-- can bench 315 quip -->
            <div class="pfp__quip pfp__quip--two">
              <p class="pfp__quip-text">
                can bench 315 lbs
                believe it or not
              </p>
              <img class="pfp__quip-arrow" src="<?php echo get_template_directory_uri(); ?>/assets/images/drawn-arrow-right-sm.svg" alt="Handrawn arrow pointing at Julian's profile picture">
            </div>
          </div>
          <img class="pfp__image" src="<?php echo get_template_directory_uri(); ?>/assets/images/julian_2018.png" alt="Julian Hernandez when he was sexy and young">
          <div class="pfp__quip-container">

            <div class="pfp__quip pfp__quip--three">
              <p class="pfp__quip-text">
                <?php echo $julian_age_years; ?> years old...
                <br>
                but looks <?php echo $julian_age_years + 5; ?>
              </p>
              <img class="pfp__quip-arrow" src="<?php echo get_template_directory_uri(); ?>/assets/images/drawn-arrow-left-md.svg" alt="Handrawn arrow pointing at Julian's profile picture">
            </div>

          </div>
        </div>

        <div class="my-card__middle">
          <div class="my-card__name-container">
            <h1 class="myname my-card__myname">
              <span class="myname__text myname__text--first">Julian</span>
              <span class="myname__text myname__text--last">Hernandez</span>
            </h1>


            <nav class="my-card__contacts">
              <ul class="my-card__contacts-list">
                <!-- Phone -->
                <li class="my-card__contacts-item">
                  <a class="my-card__contact-link my-card__contact-link--phone" href="tel:(215) 400-0468">
                    <i class="my-card__contact-icon">
                      <?php the_svg('phone', null, 'Call Julian Hernandez'); ?>
                    </i>
                    <span class="my-card__contact-link-text">
                      (215) 400-0468
                    </span>
                  </a>
                </li>

                <!-- Email -->
                <li class="my-card__contacts-item">
                  <a class="my-card__contact-link my-card__contact-link--email" href="mailto:julian@julianhernandez.com">
                    <i class="my-card__contact-icon my-card__contact-icon--mail">
                      <?php the_svg('email', null, 'Call Julian Hernandez'); ?>
                    </i>
                    <span class="my-card__contact-link-text">
                      julian@julianhernandez.me
                    </span>
                  </a>
                </li>

                <!-- Website -->
                <li class="my-card__contacts-item">
                  <div class="my-card__contact-link my-card__contact-link--website" target="_blank">
                    <i class="my-card__contact-icon my-card__contact-icon--mail">
                      <?php the_svg('website', null, 'Call Julian Hernandez'); ?>
                    </i>
                    <span class="my-card__contact-link-text">
                      julianhernandez.me
                    </span>
                  </div>
                </li>

                <!-- LinkedIn -->
                <li class="my-card__contacts-item">
                  <a class="my-card__contact-link my-card__contact-link--linkedin" href="https://linkedin.com/in/julian1729" target="_blank">
                    <i class="my-card__contact-icon my-card__contact-icon--mail">
                      <?php the_svg('linkedin', null, 'Call Julian Hernandez'); ?>
                    </i>
                    <span class="my-card__contact-link-text">
                      linkedin.com/in/julian1729
                    </span>
                  </a>
                </li>

                <!-- Github -->
                <li class="my-card__contacts-item">
                  <a class="my-card__contact-link my-card__contact-link--github" href="https://github.com/Julian1729" target="_blank">
                    <i class="my-card__contact-icon my-card__contact-icon--mail">
                      <?php the_svg('github', null, 'Call Julian Hernandez'); ?>
                    </i>
                    <span class="my-card__contact-link-text">
                      github.com/Julian1729
                    </span>
                  </a>
                </li>

              </ul>
            </nav>
          </div>
        </div>
      </div>

      <div class="my-card__footer">
        <a class="my-card__vcf-btn" href="<?php echo get_template_directory_uri(); ?>/assets/downloads/Julian Hernandez.vcf" download="JulianHernandez_FullStackDeveloper.vcf">
          Download VCF

          <i class="my-card__vcf-icon">
            <?php the_svg('download-vcf', null, 'Download VCF icon'); ?>
          </i>
        </a>
      </div>

    </div>

    <!-- Content Section -->
    <div class="header__content-section">

      <div class="header__skill-orbit skill-orbit">
        <div class="skill-orbit__ring skill-orbit__ring--outer">
          <div class="skill-orbit__item skill-orbit__item--1"><img class="skill-orbit__item-image" src="<?php echo get_template_directory_uri(); ?>/assets/icons/orbitter/node.svg" /></div>
          <div class="skill-orbit__item skill-orbit__item--2"><img class="skill-orbit__item-image" src="<?php echo get_template_directory_uri(); ?>/assets/icons/orbitter/wordpress.svg" /></div>
          <div class="skill-orbit__item skill-orbit__item--3"><img class="skill-orbit__item-image" src="<?php echo get_template_directory_uri(); ?>/assets/icons/orbitter/react.svg" /></div>
          <div class="skill-orbit__item skill-orbit__item--4"><img class="skill-orbit__item-image" src="<?php echo get_template_directory_uri(); ?>/assets/icons/orbitter/php.svg" /></div>
        </div>

        <div class="skill-orbit__ring skill-orbit__ring--inner">
          <div class="skill-orbit__item skill-orbit__item--1"><img class="skill-orbit__item-image" src="<?php echo get_template_directory_uri(); ?>/assets/icons/orbitter/mongodb.svg" /></div>
          <div class="skill-orbit__item skill-orbit__item--2"><img class="skill-orbit__item-image" src="<?php echo get_template_directory_uri(); ?>/assets/icons/orbitter/sass-round.svg" /></div>
          <div class="skill-orbit__item skill-orbit__item--3"><img class="skill-orbit__item-image" src="<?php echo get_template_directory_uri(); ?>/assets/icons/orbitter/express.svg" /></div>
          <div class="skill-orbit__item skill-orbit__item--4"><img class="skill-orbit__item-image" src="<?php echo get_template_directory_uri(); ?>/assets/icons/orbitter/figma.svg" /></div>
        </div>
      </div>

      <div class="header__content-mobile-container">

        <!-- <img class="pfp header__mobile-pfp" src="<?php echo get_template_directory_uri(); ?>/assets/images/julian_2018.png" alt="Julian Hernandez when he was sexy and young"> -->

        <?php /*
        <div class="pfp">
          <div class="pfp__quip-container">
            <!-- fat photo quip -->
            <div class="pfp__quip pfp__quip--one">
              <img class="pfp__quip-arrow" src="<?php echo get_template_directory_uri(); ?>/assets/images/drawn-arrow-right-md.svg" alt="Handrawn arrow pointing at Julian's profile picture">
              <p class="pfp__quip-text">
                uses and old photo
                <br>
                because he got fat
              </p>
            </div>

            <!-- can bench 315 quip -->
            <div class="pfp__quip pfp__quip--two">
              <p class="pfp__quip-text">
                can bench 315 lbs
                <br>
                believe it or not
              </p>
              <img class="pfp__quip-arrow" src="<?php echo get_template_directory_uri(); ?>/assets/images/drawn-arrow-right-sm.svg" alt="Handrawn arrow pointing at Julian's profile picture">
            </div>
          </div>
          <img class="pfp__image" src="<?php echo get_template_directory_uri(); ?>/assets/images/julian_2018.png" alt="Julian Hernandez when he was sexy and young">
          <div class="pfp__quip-container">

            <div class="pfp__quip pfp__quip--three">
              <p class="pfp__quip-text">
                27 years old...
                <br>
                but looks 32
              </p>
              <img class="pfp__quip-arrow" src="<?php echo get_template_directory_uri(); ?>/assets/images/drawn-arrow-left-md.svg" alt="Handrawn arrow pointing at Julian's profile picture">
            </div>

          </div>
        </div> */ ?>

        <div class="header__mobile-skill-orbit skill-orbit skill-orbit--type--photo">
          <img class="skill-orbit__center-image" src="<?php echo get_template_directory_uri(); ?>/assets/images/julian_2018.png" alt="Julian Hernandez when he was sexy and young">
          <div class="skill-orbit__ring skill-orbit__ring--outer">
            <div class="skill-orbit__item skill-orbit__item--1"><img class="skill-orbit__item-image" src="<?php echo get_template_directory_uri(); ?>/assets/icons/orbitter/node.svg" /></div>
            <div class="skill-orbit__item skill-orbit__item--2"><img class="skill-orbit__item-image" src="<?php echo get_template_directory_uri(); ?>/assets/icons/orbitter/wordpress.svg" /></div>
            <div class="skill-orbit__item skill-orbit__item--3"><img class="skill-orbit__item-image" src="<?php echo get_template_directory_uri(); ?>/assets/icons/orbitter/react.svg" /></div>
            <div class="skill-orbit__item skill-orbit__item--4"><img class="skill-orbit__item-image" src="<?php echo get_template_directory_uri(); ?>/assets/icons/orbitter/php.svg" /></div>
            <div class="skill-orbit__item skill-orbit__item--5"><img class="skill-orbit__item-image" src="<?php echo get_template_directory_uri(); ?>/assets/icons/orbitter/mongodb.svg" /></div>
            <div class="skill-orbit__item skill-orbit__item--6"><img class="skill-orbit__item-image" src="<?php echo get_template_directory_uri(); ?>/assets/icons/orbitter/sass-round.svg" /></div>
            <div class="skill-orbit__item skill-orbit__item--7"><img class="skill-orbit__item-image" src="<?php echo get_template_directory_uri(); ?>/assets/icons/orbitter/express.svg" /></div>
            <div class="skill-orbit__item skill-orbit__item--8"><img class="skill-orbit__item-image" src="<?php echo get_template_directory_uri(); ?>/assets/icons/orbitter/figma.svg" /></div>
          </div>
        </div>
        <h2 class="header__mobile-name-container">
          <span class="header__mobile-name header__mobile-name--first">Julian</span>
          <span class="header__mobile-name header__mobile-name--last">Hernandez</span>
        </h2>
      </div>

      <div class="header__title">
        <span class="header__title-text header__title-text--top">FullStack</span>
        <span class="header__title-text header__title-text--bottom">Developer</span>
      </div>

      <p class="header__content-text">

        <a class="button" href="<?php echo get_template_directory_uri(); ?>/assets/downloads/JulianHernandez_FullStackDeveloper.pdf" download>Download my resume</a>

        <span class="header__seperator-text">or learn about</span>

        <span class="header__content-text-btns">
          <a class="button">My Self</a>
          <a class="button">My Work History</a>
          <a class="button">My Projects</a>
        </span>

        <span class="header__seperator-text">or tldr</span>


        <span class="header__tldr">
          <strong>Philadelphia</strong> based full stack developer with <strong>over 7 years of professional experience</strong> with technologies such as <strong>React, Wordpress, Gutenberg, Node.js and PHP</strong>. I've worked on projects for large brands such as LASIK, Volvo, Vanguard University, United Healthcare, and Temple University.
        </span>
      </p>



    </div>
  </div>

</header>

<main class="main">
  <!-- <div class="main-splat">
    <img class="main-splat__image" src="<?php echo get_template_directory_uri(); ?>/assets/images/main-splat.svg" alt="Colorful paint splat">
  </div> -->

  <div class="main-splat-container">

    <section class="skills-section container">

      <h2 class="section-header">My Skills</h2>

      <?php get_template_part('template-parts/content', 'skills-list'); ?>

    </section>

    <section class="portfolio-section" id="my-work">

      <div class="container">

        <h2 class="section-header">My Projects</h2>

        <!-- Featured Portfolio Items -->
        <ul class="portfolio-section__featured-list">

          <?php

          while ($projects_query->have_posts()) {
            $projects_query->the_post();
            if (!get_field('featured', $post->ID)) continue;
            get_template_part('template-parts/content', 'project-item');
          }
          wp_reset_postdata();

          ?>

        </ul>

        <!-- Regular Portfolio Items -->
        <ul class="portfolio-section__regular-list">

          <?php

          while ($projects_query->have_posts()) {
            $projects_query->the_post();
            if (get_field('featured', $post->ID)) continue;
            get_template_part('template-parts/content', 'project-item');
          }
          wp_reset_postdata();

          ?>

        </ul>

      </div>

    </section>

  </div>

  <section class="work-section ">

    <div class="container">

      <h2 class="section-header work-section__section-header">My Work History</h2>

      <ul class="work-section__list">
        <?php
        foreach ($work_history as $item) {
          get_template_part('template-parts/content', 'work-item', ['item' => $item]);
        }
        ?>
      </ul>
    </div>


  </section>


</main><!-- #main -->

<?php
get_footer();
