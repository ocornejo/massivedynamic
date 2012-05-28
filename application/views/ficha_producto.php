<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Massive Dynamic, un universo de software</title>
<?php $this->load->helper('url'); ?>

<link rel="icon" href="<?php echo base_url()?>images/favicon.gif" type="image/x-icon"/>
<link rel="shortcut icon" href="<?php echo base_url()?>images/favicon.gif" type="image/x-icon"/> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/styles.css"/>
<link type="text/css" href="<?php echo base_url()?>css/fancymoves.css" media="screen" charset="utf-8" rel="stylesheet"  />

  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js" charset="utf-8"></script>
  <script type="text/javascript" src="<?php echo base_url()?>js/slider.js" charset="utf-8"></script>

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
                    <li><a href="#">Register</a></li>
                    <li><a href="#">Login</a></li>
                </ul></nav>
        </div>
    </header>
    
    <div id="container">
        <section id="intro">
            <?php
            foreach ($producto->result() as $row){?>
            <table>
            <tr>
            <td rowspan="5"><?php echo "<img src='data:image/png;base64,".base64_encode($row->Img)."'>";?></td>
            <td><b>Nombre:</b></td>
            <td><?php echo $row->Nombre;?></td>
            </tr>
            <tr>
            <td><b>C&oacute;digo:</b></td>
            <td><?php echo $row->Codigo;?></td>
            </tr>
            <tr>
            <td><b>Plataforma:</b></td>
            <td><?php echo $row->Plataforma;?></td>
            </tr>
            <tr>
            <td><b>Precio:</b></td>
            <td><?php echo "$".$row->Precio;?></td>
            </tr>
            <tr>
            <td><b>Descripci&oacute;n:</b></td>
            <td><?php echo $row->Descripcion;?></td>
            </table>
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