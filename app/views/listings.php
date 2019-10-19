<!DOCTYPE html>
<html>
    <head>
        <title>Welcome to SpyStuff.com</title>
        <?php include('meta.php'); ?>
    </head>
    <body>



        <div class="main clearfix">
            <?php include('header.php'); ?>

            <?php
            foreach ($content as $product):
                ?>
                <div class="product clearfix">
                    <div class="image" style="background-image: url('/product_images/<?= $product['images'][0] ?>')"></div>
                    <div class='descriptives clearfix'>
                        <div class='product_name'><?= $product['product_name'] ?></div>
                        <div class='base_price'>
                            <?php
                            if ($product['use_options'] == 'none'):
                                print "\${$product['base_price']}";
                            else:
                                print "From \${$product['base_price']}";
                            endif;
                            ?>
                        </div>
                    </div>

                    <a href='/listing_detail/<?= $product['id'] ?>' class='button'>Learn More</a>
                </div>

                <?php
            endforeach;
            ?>  
<?php include('footer.php'); ?>

        </div>

<?php include('scripts.php'); ?>

    </body>
</html>

