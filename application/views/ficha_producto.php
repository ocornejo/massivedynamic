<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Massive Dynamic, un universo de software</title>
<?php $this->load->helper('url');
      $this->load->helper('form');
      $this->load->library('cart');?>

<link rel="icon" href="<?php echo base_url()?>images/favicon.gif" type="image/x-icon"/>
<link rel="shortcut icon" href="<?php echo base_url()?>images/favicon.gif" type="image/x-icon"/> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/styles.css"/>
<link type="text/css" href="<?php echo base_url()?>css/fancymoves.css" media="screen" charset="utf-8" rel="stylesheet"  />

  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js" charset="utf-8"></script>
  <script type="text/javascript" src="<?php echo base_url()?>js/slider.js" charset="utf-8"></script>
  
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

  <script type="text/javascript" src="<?php echo base_url()?>demo/demo.js"></script>
  
  <!-- FancyBox scripts -->
  <script type="text/javascript" src="<?php echo base_url()?>fancybox-1.3.4/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
  <script type="text/javascript" src="<?php echo base_url()?>fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.css" media="screen" />

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
                    <li><?php echo "<a href='".site_url('controller_catalogo/index/')."'>Cat&aacute;logo</a>"?></li>
                    <li><?php echo "<a href='".site_url('controller_registro/registrar/')."'>Registro</a>"?></li>
                    <li><?php echo "<a href='".site_url('controller_login/login/')."'>Login</a>"?></li>
                </ul></nav>
        </div>
    </header>
    
    <div id="container" >
        <section id="intro">
            <?php
            foreach ($producto->result() as $row){?>
            <h1><p><?php echo $row->Nombre;?></p></h1>
            <table border="0" id="producto">
                <tr>
                    <td valign="top" rowspan="4" width="300"><?php echo "<img style='border-radius:10px; border-top-right-radius:70px;' src='data:image/png;base64,".$row->Img."'>";?></td>
                    <td width="90"><p><strong>C&oacute;digo:</strong></p></td>
                    <td><p><?php echo $row->Codigo;?></p></td>
                    <td valign="right" width="200"><center><b>Agregar al carrito:</b></center></td>
                </tr>
                <tr>
                    <td><p><strong>Plataforma:</strong></p></td>
                    <td><p><?php echo $row->Plataforma;?></p></td>
                    <td><center>
                        <?php echo form_open('controller_catalogo/addToCart'); ?>
                        Cantidad: <select size='1' name='cant'>
                            <option selected value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select></form>
                        
                        </center>
                    </td>
                </tr>
                <tr>
                    <td><p><strong>Precio:</strong></p></td>
                    <td><p><?php echo "$".$row->Precio;?></p></td>
                    <td><div class="ficha_producto">
                        <center><?php //echo form_open('controller_catalogo/addToCart');  
                              echo form_hidden('product_id', $row->Codigo);
                              
                              //echo form_hidden('quantity', 3);
                              echo form_submit('add', 'Agregar');
                              echo form_close();?></center>
                        </div></td>
                </tr>
                <tr>
                    <td valign="top" width="100"><p><b>Descripci&oacute;n:</b></p></td>
                    <td><p style="text-align:justify"><?php echo utf8_decode($row->Descripcion);?></p></td>
                    <td></td>
                </tr>
            </table>
            <?php } ?>
            <div id="wrap">

            <div class="cart_list">
                <br/><br/><h3>Tu carro de compras</h3>
                <div id="cart_content">
                    <?php
                    if ($cart_items==0):
                        echo 'No tienes ning&uacute;n producto todav&iacute;a.';
                    else:
                        ?>
                    <div class="update">
                    <?php echo form_open('controller_catalogo/updateCart'); ?>
                        <table border="1" width="100%" cellpadding="0" cellspacing="0">
                            <thead>
                                <tr width="700px">
                                    <td><strong>Descripci&oacute;n</strong></td>
                                    <td width="100px"><strong><center>Cantidad</center></strong></td> 
                                    <td><strong>Precio</strong></td>
                                    <td><strong>Sub-Total</strong></td>
                                    <td width="100px"><strong><center>Eliminar</center></strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($this->cart->contents() as $items): ?>

                                    <?php echo form_hidden('rowid[]', $items['rowid']); ?>
                                            <tr <?php if ($i & 1) {
                                                        echo 'class="alt"';
                                                      } 
                                                ?>
                                            >
                                        <td><?php echo $items['name']; ?></td>
                                        <td><center><?php echo $items['qty']; ?></center></td>
                                        <td>$<?php echo $this->cart->format_number($items['price']); ?></td>
                                        <td>$<?php echo $this->cart->format_number($items['subtotal']); ?></td>
                                        <td><center><img src="<?php echo base_url()?>images/delete.png" /></center></td>
                                    </tr>

                        <?php $i++; ?>
                        <?php endforeach; ?>

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><strong>Total</strong></td>
                                    <td>$<?php echo $this->cart->format_number($this->cart->total()); ?></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table><br/>

                        <p><?php echo anchor('controller_catalogo/emptyCart', 'Vac&iacute;a carro', 'class="empty"'); ?></p>
                      <?php
                     echo form_close();
                     endif;
?>
                    </div>
                </div>
            </div>
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