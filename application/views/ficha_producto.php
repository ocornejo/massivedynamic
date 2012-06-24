<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Massive Dynamic, un universo de software</title>
        <?php
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('cart');
        ?>

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

        <!-- FancyBox scripts -->
        <script type="text/javascript" src="<?php echo base_url() ?>fancybox-1.3.4/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.css" media="screen" />

        <script type="text/javascript">
            $(document).ready(function() {
                $("a.pop1").fancybox();
          
                $("a.pop2").fancybox({
                    'overlayShow'	: false,
                    'transitionIn'	: 'elastic',
                    'transitionOut'	: 'elastic'
                });
          
                $("a.pop3").fancybox({
                    'transitionIn'	: 'none',
                    'transitionOut'	: 'none',
                    'overlayColor'	: '#000',
                    'overlayOpacity'	: 0.7
                });
          
                $("a.pop4").fancybox({
                    'opacity'		: true,
                    'overlayShow'	: false,
                    'transitionIn'	: 'elastic',
                    'transitionOut'	: 'none'
                });
          
                $("a.pop5").fancybox();
          
                $("a#example6").fancybox({
                    'titlePosition'	: 'outside',
                    'overlayColor'	: '#000',
                    'overlayOpacity'	: 0.9
                });
          
                $("a.pop6").fancybox({
                    'titlePosition'	: 'inside'
                });
          
                $("a.pop7").fancybox({
                    'titlePosition'	: 'over'
                });
            });
        </script>

    </head>
    <body>
        <header>
            <div id="container">
                <h1 class="fontface" id="title">MDS</h1>
                <nav><ul>
                        <li><a href="#">Home</a></li>
                        <li><?php echo "<a href='" . site_url('controller_catalogo/index/') . "'>Cat&aacute;logo</a>" ?></li>
                        <li><?php echo "<a href='" . site_url('controller_registro/registrar/') . "'>Registro</a>" ?></li>

                        <?php
                        $this->load->library('session');
                        if ($this->session->userdata('Username') != null) {
                            echo "<li><a href='" . site_url('controller_login/logout/') . "'>Logout</a></li>";
                            echo "</ul></nav>";
                            echo " Bienvenido " . $this->session->userdata('Username');
                        } else {
                            echo "<li><a href='" . site_url('controller_login/login/') . "'>Login</a></li>";
                            echo "</ul></nav>";
                        }
                        ?>
                        </div>
                        </header>


                        <div id="container" >
                            <section id="intro">
                                <?php foreach ($producto->result() as $row) { ?>
                                    <h1><p><?php echo $row->Nombre; ?></p></h1>
                                    <table border="0" id="producto">
                                        <tr>
                                            <td valign="top" rowspan="4" width="300"><?php echo "<img style='border-radius:10px; border-top-right-radius:70px;' src='data:image/png;base64,".$row->Img."'>"; ?></td>
                                            <td width="90"><p><strong>C&oacute;digo:</strong></p></td>
                                            <td><p><?php echo $row->Codigo; ?></p></td>
                                            <td valign="right" width="200"><center><b>
                                                <?php
                                                $fuecomprado = $compra;
                                                if ($fuecomprado == "si") {
                                                    echo "Usted ya ha comprado este producto</br>Puede volver a descargarlo gratuitamente";
                                                } else {
                                                    if ($this->session->userdata('Username') != null) {
                                                        echo "Agregar al carrito:";
                                                    } else {
                                                        echo "Necesita loguearse para comprar";
                                                    }
                                                }
                                                ?>
                                            </b></center></td>
                                        </tr>
                                        <tr>
                                            <td><p><strong>Plataforma:</strong></p></td>
                                            <td><p><?php echo $row->Plataforma; ?></p></td>
                                            <td><div><center> 
    <?php
    if ($fuecomprado == "no") {
        if ($this->session->userdata('Username') != null) {
            echo "Cantidad:";
        } else {
            echo "<a href='" . site_url('controller_login/login/') . "'>Login</a>";
        }
    } else {
         echo "<center><a href='".site_url("controller_descarga/bajar/").$row->Codigo."'>Descargar</a></center>";
    }

    $options = array(
        '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5',
        '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10',
    );
    ?></td>
                                                        <td><div>
                                                                <center class="ficha_producto">

                                                        <?php
                                                        if ($fuecomprado == "no") {
                                                            if ($this->session->userdata('Username') != null) {
                                                                echo form_open('controller_catalogo/addToCart');
                                                                echo form_input('quantity', '1', 'maxlength="2"');
                                                                echo form_hidden('product_id', $row->Codigo);
                                                                echo form_submit('add', 'Agregar');
                                                                echo form_close();
                                                            }
                                                        }
                                                        ?>
                                                                </center></div></td>

                                                        </tr>
                                                        <tr>
                                                            <td><p><strong>Precio:</strong></p></td>
                                                            <td><p><?php echo "$" . $row->Precio; ?></p></td>

                                                        </tr>
                                                        <tr>
                                                            <td valign="top" width="100"><p><b>Descripci&oacute;n:</b></p></td>
                                                            <td><p style="text-align:justify"><?php echo utf8_decode($row->Descripcion); ?></p></td>
                                                            <td></td>
                                                        </tr>
                                                        </table>
                                <?php } ?>
                                                    <div id="wrap">

                                                        <div class="update">
                                                            
                                                                                                                
                                                            
                                                        <?php echo form_open('controller_catalogo/updateCart'); ?>
                                                            <table cellpadding="0" cellspacing="0" style="100%" border="1">
                                                                <tr width="700px">
                                                                    <th>Cantidad</th>
                                                                    <th>Descripci&oacute;n</th>
                                                                    <th style="text-align:right">Precio unitario</th>
                                                                    <th style="text-align:right">Sub-Total</th>
                                                                </tr>
                                                            <?php $i = 1; $nombres=":";?>
                                                            <?php foreach ($this->cart->contents() as $items): ?>
                                                                <?php echo form_hidden($i . '[rowid]', $items['rowid']);
                                                                      echo form_hidden('url',uri_string());
                                                                ?>

                                                                    <tr>
                                                                        <td><?php echo form_input(array('name' => $i . '[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); ?></td>
                                                                        <td>
                                                                    <?php echo $items['name'];
                                                                    $nombres=$nombres." ".$items['name'];
                                                                    ?>

                                                                    <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>

                                                                                <p>
                                                                        <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>

                                                                                        <strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />

                                                                                <?php endforeach; ?>
                                                                                </p>

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
                                                            </table>
                                                            <p><?php echo form_submit('', 'Actualizar','class="update"'); ?></p>
                                                            <p><?php echo anchor('controller_catalogo/emptyCart', 'Vac&iacute;a carro', 'class="empty"'); ?></p>
                                                            


                                                        </div>
                                                    </div><br/>
                                                   <br/><br/>
                                                        <?php echo "<a href='" . site_url('controller_paypal/ppp/') . "'><img src='http://cdn5.iconfinder.com/data/icons/socialize-part-3-icons-set/128/paypal.png' width='100px' /></a>" ?>
                                                    <?php
                                   
                                                    echo "<a href='" . site_url('controller_pagofacebook/pagarconpost/ ').$nombres."'><img src='http://www.2012-granhermano.com.ar/facebook.png' width='100px' /></a>"
                                                            ?>
                                     

                                            </div>
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
