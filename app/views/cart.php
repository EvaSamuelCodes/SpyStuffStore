<!DOCTYPE html>
<html>
    <head>
        <title>Your shopping cart | SpyStuff.com</title>
        <?php include('meta.php'); ?>
    </head>
    <body>
        <div class="main clearfix">
            <?php include('header.php'); ?>

            <div class="detail clearfix">
                <h2 class="docenter">Your Shopping Cart</h2>
                <?php
                if (count($_SESSION['cart']['items'])):
                    ?>
                    <table border="1" class="cart_table">
                        <tr>                            
                            <th>&nbsp;</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>SKU</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                        <?php
                        $final_subtotal = [];
                        foreach ($_SESSION['cart']['items'] as $key => $row) :
                            $final_subtotal[] = $row['qty'] * $row['base_price'];
                            ?>
                            <tr>
                                <td class="docenter"><img src="/product_images/<?= $row['thumb'] ?>" style="height:60px"/></td>
                                <td>
                                    <?= $row['product_name'] ?>
                                    <?php
                                    if (isset($row['variant'])):
                                        print "<li>" . ($row['variant']['variant_name']) . "</li>";
                                    endif;
                                    ?>
                                </td>
                                <td>$<?= $row['base_price'] ?></td>
                                <td><?= $row['sku'] ?></td>
                                <td><?= $row['qty'] ?></td>
                                <td>$<?= $row['qty'] * $row['base_price'] ?></td>
                                <td class="docenter"><a class="button" href="/ecart/remove/<?= $key ?>">Remove</a></td>
                            </tr>
                        <?php endforeach; ?> 
                        <tr>
                            <td colspan="4"></td>
                            <td>Subtotal</td>
                            <td>$<?= array_sum($final_subtotal) ?></td>
                        </tr>
                    </table>
                    <div class="cartbuttons docenter">
                        <a href='/ecart/clear' class='button'>Empty Cart</a>
                        <a href='/' class='button'>Keep Shopping</a>
                        <a href="/checkout"  class='button'>Checkout</a>
                    </div>

                    <?php
                else:
                    ?>
                    <div class="alert">There's nothing in your cart. It's time to buy something.</div>
                <?php
                endif;
                ?>

            </div>        <?php include('footer.php'); ?>

        </div>
        <?php
        //$this->pretty($_SESSION['cart']);
        ?>
        <?php include('scripts.php'); ?>

    </body>
</html>