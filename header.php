<!-- <!DOCTYPE html>
<html <?php //language_attributes(); ?>>

<head>
    <meta charset="<?php //bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php //wp_head(); ?>
</head>

<body <?php //body_class(); ?>>
    <?php //wp_body_open(); ?>

    <header x-data="{ atTop: true }" @scroll.window="atTop = (window.scrollY > 10) ? false : true" id="masthead"
        class="site-header fixed top-0 left-0 right-0 z-40 transition-colors duration-300"
        :class="{ 'bg-transparent': atTop, 'shadow-lg bg-base-100/95 backdrop-blur-sm': !atTop }">
        <?php
    // We will now call the navbar from inside the header
    //get_template_part('template-parts/components/navbar'); 
    ?>
    </header>
    <main id="main" class="site-main pt-28 pb-16 md:pt-32 md:pb-24"> -->

<!DOCTYPE html>
<html <?php language_attributes(); ?> data-theme="nord">

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <header x-data="{ atTop: true }" @scroll.window="atTop = (window.scrollY > 10) ? false : true" id="masthead"
        class="site-header fixed top-0 left-0 right-0 z-40 transition-colors duration-300"
        :class="{ 'bg-transparent': atTop, 'shadow-lg bg-base-100/95 backdrop-blur-sm': !atTop }">
        <?php
        // We will now call the navbar from inside the header
        get_template_part('template-parts/components/navbar'); 
        ?>
    </header>
    <main id="main" class="site-main pb-16  md:pb-24">