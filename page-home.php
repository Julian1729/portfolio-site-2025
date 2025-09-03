<?php

get_header();
?>

<header class="header">

  <button class="header__idcta idcta">
    <img class="idcta__icon" src="<?php echo get_template_directory_uri(); ?>/assets/icons/id.svg" alt="ID card icon">
  </button>

  <div class="header__inner">
    <div class="my-card header__my-card">
      <div class="my-card__main">
        <div class="my-card__pfp-container">
          <img class="pfp my-card__pfp" src="<?php echo get_template_directory_uri(); ?>/assets/images/julian_2018.png" alt="Julian Hernandez when he was sexy and young">
        </div>

        <div class="my-card__name-container">
          <h1 class="myname">
            <span class="myname__text myname__text--first">Julian</span>
            <span class="myname__text myname__text--last">Hernandez</span>
          </h1>


          <nav class="my-card__contacts">
            <ul class="my-card__contacts-list">
              <!-- Phone -->
              <li class="my-card__contacts-item">
                <a href="tel:(215) 400-0468" class="my-card__contact-link">
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
                <a class="my-card__contact-link" href="mailto:julian@julianhernandez.com">
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
                <div class="my-card__contact-link" target="_blank">
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
                <a class="my-card__contact-link" href="https://linkedin.com/in/julian1729" target="_blank">
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
                <a class="my-card__contact-link" href="https://github.com/Julian1729" target="_blank">
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

      <div class="my-card__footer">
        <a class="my-card__vcf-btn" href="">
          Download VCF

          <i class="my-card__vcf-icon">
            <?php the_svg('download-vcf', null, 'Download VCF icon'); ?>
        </a>
      </div>

    </div>

    <div class="header__content-section">

      <div class="header__content-mobile-container">

        <img class="pfp header__mobile-pfp" src="<?php echo get_template_directory_uri(); ?>/assets/images/julian_2018.png" alt="Julian Hernandez when he was sexy and young">

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

        <a class="button">Download my resume</a>

        <span class="header__seperator-text">or learn about</span>

        <span class="header__content-text-btns">
          <a class="button">My Self</a>
          <a class="button">My Work History</a>
          <a class="button">My Projects</a>
        </span>

        <span class="header__seperator-text">or TLDR</span>


        <span class="header__tldr">
          <strong>Philadelphia</strong> based full stack developer with <strong>over 7 years of professional experience</strong> with technologies such as <strong>React, Wordpress, Gutenberg, Node.js and PHP</strong>. I've worked on projects for large brands such as LASIK, Volvo, Vanguard University, United Healthcare, and Temple University.
        </span>
      </p>



    </div>
  </div>



</header>

<main class="main">



</main><!-- #main -->

<?php
get_footer();
