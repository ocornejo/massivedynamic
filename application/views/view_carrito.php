<html>
<head>
    <meta charset="UTF-8">
    <title>Massive Dynamic, un universo de software</title>
    
    <link rel="icon" href="<?php echo base_url() ?>images/favicon.gif" type="image/x-icon"/>
    <link rel="shortcut icon" href="<?php echo base_url() ?>images/favicon.gif" type="image/x-icon"/> 
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/styles.css"/>
    <link type="text/css" href="<?php echo base_url() ?>css/fancymoves.css" media="screen" charset="utf-8" rel="stylesheet"  />

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>js/slider.js" charset="utf-8"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/core.js"></script>

    <style type="text/css" media="screen">
        @font-face {
            font-family: 'BebasNeueRegular';
            src: url('BebasNeue-webfont.eot');
            src: url('BebasNeue-webfont.eot?#iefix') format('embedded-opentype'),
                    url('BebasNeue-webfont.woff') format('woff'),
                    url('BebasNeue-webfont.ttf') format('truetype'),
                    url('BebasNeue-webfont.svg#BebasNeueRegular') format('svg');
            font-weight: normal;
            font-style: normal;
        }
        h1.fontface {font: 72px/80px 'BebasNeueRegular', Arial, sans-serif;letter-spacing: 0;}
        h2.fontface {font: 35px/43px 'BebasNeueRegular', Arial, sans-serif;letter-spacing: 0;}
        h3.fontface {font: 25px/33px 'BebasNeueRegular', Arial, sans-serif;letter-spacing: 2px;}
        h4.fontface {font: 20px/28px 'BebasNeueRegular', Arial, sans-serif;letter-spacing: 0;}
        p.style1 {font: 18px/27px 'BebasNeueRegular', Arial, sans-serif;}
    </style>

    <script type="text/javascript" src="<?php echo base_url() ?>demo/demo.js"></script>
</head>

<body>
    <header>
    <div id="container">
        <h1 class="fontface" id="title">MDS</h1>
        <nav><ul>
            <li><?php echo "<a href='".site_url('controller_catalogo/index/')."'>Cat&aacute;logo</a>" ?></li>
            
            <?php
            $this->load->library('session');
            if ($this->session->userdata('Username') != null) {
                echo "<li><a href='" . site_url('controller_producto/productoscomprados/') . "'>Descargas</a></li>";
                echo "<li><a href='" . site_url('controller_catalogo/showCart/') . "'>Carrito</a></li>";
                echo "<li><a href='" . site_url('controller_login/logout/') . "'>Logout</a></li>";
                echo "</ul></nav>";
                echo " Bienvenido " . $this->session->userdata('Username');
            } else {
                echo "<li><a href='" . site_url('controller_registro/registrar/') . "'>Registro</a></li>";
                echo "<li><a href='" . site_url('controller_login/login/') . "'>Login</a></li>";
                echo "</ul></nav>";
            }?>
    </div>
    </header>

    <div id="container" >
        <section id="intro">
            <div id="wrap">
            <div class="update">
                <h3><u>Mi carrito de compras</u></h3><br/>
                <?php echo form_open('controller_catalogo/updateCart'); ?>
                <table border="1">
                    <tr width="700px">
                        <td width="100px"><center><strong>Cantidad</strong></center></td>
                        <td width="600px"><strong><center>Descripci&oacute;n</center></strong></td>
                        <td><strong>Precio unitario</strong></td>
                        <td><strong>Sub-Total</strong></td>
                    </tr>
                    <?php $i = 1; $nombres=" ";?>
                    <?php foreach ($this->cart->contents() as $items): ?>
                        <?php echo form_hidden($i . '[rowid]', $items['rowid']);
                        echo form_hidden('url',uri_string());?>
                    <tr>
                        <td><?php echo form_input(array('name' => $i . '[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); ?></td>
                        <td>
                            <?php echo $items['name'];
                            $nombres=$nombres."-".$items['name'];?>

                            <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>
                                <p>
                                <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
                                    <strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />
                                <?php endforeach; ?></p>
                            <?php endif; ?>
                        </td>
                        <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
                        <td style="text-align:right">$<?php echo $this->cart->format_number($items['subtotal']); ?></td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="2"> </td>
                        <td ><strong>Total</strong></td>
                        <td >$<?php echo $this->cart->format_number($this->cart->total()); ?></td>
                    </tr>
                </table><br/>
                
                <p><?php echo form_submit('', 'Actualizar','class="update"'); ?></p><br/>
                <strong><p><?php echo anchor('controller_catalogo/emptyCart', '<< VACIAR CARRITO >>', 'class="empty"'); ?></p></strong>
                <strong><p><?php echo "<a href='".site_url('controller_catalogo/index/')."'><< SEGUIR COMPRANDO >></a>" ?></p></strong>
                </form>
            </div>
            </div><br/>
            
            <strong><u>Elija su medio de pago:</u></strong>
            <table border="0">
            <tr>
            <td><?php $this->load->library('cart');
                $num = 1;
                $json = file_get_contents('http://currencies.apps.grandtrunk.net/getlatest/usd/clp');
                $data = (int) json_decode($json, TRUE); //set to productTotal + shipmentFee + tax;
                ?>

                <form action='https://www.sandbox.paypal.com/cgi-bin/webscr' method='post' name='frmPayPal'>
                    <input type='hidden' name='cmd' value='_cart'>
                    <input type='hidden' name='upload' value='1'> 
                    <input type='hidden' name='business' value='qwerty_1342637978_biz@gmail.com'>
            
                    <?php foreach($this->cart->contents() as $items): ?>
                    <input type='hidden' name='item_name_<?php echo $num;?>' value='<?php echo $items['name']; ?>'>
                    <input type='hidden' name='item_number_<?php echo $num;?>' value='<?php echo $items['id']?>'>
                    <input type='hidden' name='amount_<?php echo $num;?>' value='<?php echo (int)($items['price'] / $data) ?>'>
                    <input type='hidden' name='quantity_<?php echo $num;?>' value='<?php echo $items['qty']; ?>'>
                    <?php $num = $num + 1; 
                    endforeach;?>
            
                    <input type='hidden' name='currency_code' value='USD'>
                    <input type='hidden' name='cancel_return' value='http://massivedynamic.inf.utfsm.cl'>
                    <input type='hidden' name='return' value='http://massivedynamic.inf.utfsm.cl/index.php/controller_paypal/index'>
                    <input type='image' src='http://cdn5.iconfinder.com/data/icons/socialize-part-3-icons-set/128/paypal.png' width='100px' name='submit' alt='Pagar ahora' />
                </form>
                <script language="JavaScript" type="text/javascript">
                    window.onload=function() {
                    window.document.frmPaypal.submit();
                    }
                </script>
            </td>
            <td>
                <?php echo form_open('controller_pagofacebook/prueba');
                    $num=0;
                    foreach ($this->cart->contents() as $items):
                        echo '<input type="hidden" name="nombre'.$num.'" value="'.$items['name'].'" />';
                        echo '<input type="hidden" name="codigo'.$num.'" value="'.$items['id'].'" />'; 
                        $num=$num+1;
                    endforeach;
                    echo '<input type="hidden" name="cantidad" value="'.$num.'" />';
                    echo '<input type="image" src="http://www.2012-granhermano.com.ar/facebook.png" width="100px" >';
                    echo "</form>"?>
            </td>
            </tr>
 
            <tr>
            <td><center>Paypal</center></td>
            <td><center>Facebook</center></td>
            </tr>
            </table>
        </section>
    </div>

    <footer>
        <div class="container">
        <br>
        <p>© 2012 Massive Dynamic Store</p>
        </div>
    </footer>
</body>
</html>