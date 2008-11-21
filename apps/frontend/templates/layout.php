<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include_http_metas() ?>
<?php include_metas() ?>

<?php include_title() ?>

<link rel="shortcut icon" href="/favicon.ico" />

</head>
<body>

<div id="header">
    <ul>
        <li><?php echo link_to("about", "@homepage") ?></li>
    </ul>
    <h1><?php echo link_to(image_tag("askeet_logo.gif", "alt=askeet"), "@homepage") ?></h1>
</div>

<div id="content">
    <div id="content_main">
        <?php echo $sf_content ?>
        <div class="verticalalign"></div>
    </div>

    <div id="content_bar">
        <!-- Nothing for the wait -->
        <div class="verticalalign"></div>
    </div>
</div>

</body>
</html>
