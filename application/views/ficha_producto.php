<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Massive Dynamic, un universo de software</title>
<?php $this->load->helper('url');
      $this->load->helper('form');?>

<link rel="icon" href="<?php echo base_url()?>images/favicon.gif" type="image/x-icon"/>
<link rel="shortcut icon" href="<?php echo base_url()?>images/favicon.gif" type="image/x-icon"/> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/styles.css"/>
<link type="text/css" href="<?php echo base_url()?>css/fancymoves.css" media="screen" charset="utf-8" rel="stylesheet"  />

  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js" charset="utf-8"></script>
  <script type="text/javascript" src="<?php echo base_url()?>js/slider.js" charset="utf-8"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.3.2.min.js"></script>  
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
                    <li><?php echo "<a href='".site_url('controller_catalogo/index/')."'>Catálogo</a>"?></li>
                    <li><?php echo "<a href='".site_url('controller_registro/registrar/')."'>Registro</a>"?></li>
                    <li><?php echo "<a href='".site_url('controller_login/login/')."'>Login</a>"?></li>
                </ul></nav>
        </div>
    </header>
    
    <div id="container" >
        <section id="intro"class="ficha_producto" >
            <?php
            foreach ($producto->result() as $row){?>
            <h1><p><?php echo $row->Nombre;?></p></h1>
            <table cellspacing="5">
            <tr>
            <td rowspan="4" width="300"><?php echo "<img src='data:image/png;base64,".$row->Img."'>";?></td>
            <td><p><b>C&oacute;digo:</b></p></td>
            <td><p><?php echo $row->Codigo;?></p></td>
            <td></td>
            </tr>
            <tr>
            <td><p><b>Plataforma:</b></p></td>
            <td><p><?php echo $row->Plataforma;?></p></td>
            <td></td>
            </tr>
            <tr>
            <td><p><b>Precio:</b></p></td>
            <td><p><?php echo "$".$row->Precio;?></p></td>
            <td></td>
            </tr>
            <td valign="top" width="100"><p><b>Descripci&oacute;n:</b></p></td>
            <td><p><?php echo utf8_decode($row->Descripcion);?></p></td>
            <td></td>
            </tr>
            </table>
            
                <?php  echo form_open('controller_catalogo/addToCart');  
                  echo form_hidden('Codigo', $row->Codigo);  
                  echo form_submit('add', 'Anadir al carro');
                  echo form_close();
                ?>  
            
            <?php } ?>
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