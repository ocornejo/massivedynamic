<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en-us" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>CodeIgniter Shopping Cart</title>


        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/core.js"></script>
    </head>
    <body>

        <div id="wrap">

            <?php $this->view($content); ?>

            <div class="cart_list">
                <h3>Your shopping cart</h3>
                <div id="cart_content">
                    <?php echo $this->view('cart/cart.php'); ?>
                    <?php
                    if (!$this->cart->contents()):
                        echo 'You don\'t have any items yet.';
                    else:
                        ?>

                    <?php echo form_open('cart/update_cart'); ?>
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <td>Item Description</td>
                                    <td>Item Price</td>
                                    <td>Sub-Total</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($this->cart->contents() as $items): ?>

                                    <?php echo form_hidden('rowid[]', $items['rowid']); ?>
                                    <tr <?php if ($i & 1) {
            echo 'class="alt"';
        } ?>>
                                        <td>
        <?php echo form_input(array('name' => 'qty[]', 'maxlength' => '3', 'size' => '5')); ?>
                                        </td>

                                        <td><?php echo $items['name']; ?></td>

                                        <td>&euro;<?php echo $this->cart->format_number($items['price']); ?></td>
                                        <td>&euro;<?php echo $this->cart->format_number($items['subtotal']); ?></td>
                                    </tr>

                        <?php $i++; ?>
                        <?php endforeach; ?>

                                <tr>
                                    <td</td>
                                    <td></td>
                                    <td><strong>Total</strong></td>
                                    <td>&euro;<?php echo $this->cart->format_number($this->cart->total()); ?></td>
                                </tr>
                            </tbody>
                        </table>

                        <p><?php echo form_submit('', 'Update your Cart');
    echo anchor('cart/emptyCart', 'Empty Cart', 'class="empty"'); ?></p>
                        <p><small>If the quantity is set to zero, the item will be removed from the cart.</small></p>
    <?php
    echo form_close();
endif;
?>

                </div>
            </div>
        </div>

    </body>
</html>