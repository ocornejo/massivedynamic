
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
    
    .fila{clear:left;}
    
.LoginUsuariosCabecera{
	
	background-color: #1D9995;
	width:130px;
	height:20px;
}

.LoginUsuariosDato{	
	width:230px;
	height:20px;
}
.LoginUsuariosError{
	float:left;
	width:500px;
	height:20px;
	color:#FF0000;
}

.LoginUsuariosError p{
	vertical-align:top;
	margin-top:3px;
	margin-left:3px;
}
#formulario{
     margin:0 auto 0 auto;
     width: 400px;
}
</style>

  

</head>
<body>
    <header>
        <div id="container">
            <h1 class="fontface" id="title">MDS</h1>
            <nav><ul>
                    <li><a href="#">Home</a></li>
                    <li><?php echo "<a href='".site_url('controller_catalogo/index/')."'>Cat&aacute;logo</a>"?></li>
                    <li><?php echo "<a href='".site_url('controller_registro/registrar/')."'>Registro</a>"?></li>
                
            <?php
            $this->load->library('session');
              if($this->session->userdata('Username')!=null){
                  echo "<li><a href='".site_url('controller_login/logout/')."'>Logout</a></li>";
                  echo "</ul></nav>";
                  echo " Bienvenido ".$this->session->userdata('Username');
              }
              else{
                  echo "<li><a href='".site_url('controller_login/login/')."'>Login</a></li>";
                  echo "</ul></nav>";
              }
              ?>
        </div>
    </header>
    
    
    <div id="container">
        <section id="intro">
           
            <div id="formulario">
           <?php echo  form_open('controller_registro/registrar'); ?>
<div class="Info">
    <p class="Titulo">Obtenga ahora su cuenta en Massive Dynamics y acceda a un universo de diversi&oacute;n</p>
    <p>&nbsp;</p>    
</div>
<div id="LoginUsuarios">
    <div class="fila">
        <div class="LoginUsuariosCabecera">Usuario:</div>
        <div class="LoginUsuariosDato"><input type="text" name="username" value="<?PHP set_value('username'); ?>" size="25" /></div>
        <div class="LoginUsuariosError">
        <?PHP
        if(isset ($error)){
            echo  "<p>".$error."</p>";
        }
        echo  form_error('username');
        ?>
        </div>
    </div>        
    <div class="fila">
        <div class="LoginUsuariosCabecera">Contrase&ntilde;a:</div>
        <div class="LoginUsuariosDato"><input type="password" name="passwordlogin" value="<?PHP set_value('passwordlogin'); ?>" size="25" /></div>
        <div class="LoginUsuariosError"><?PHP form_error('passwordlogin');?></div>
    </div>
    <div class="fila">
        <div class="LoginUsuariosCabecera">Nombre</div>
        <div class="LoginUsuariosDato"><input type="text" name="nombre" value="<?PHP set_value('nombre'); ?>" size="50" /></div>
        <div class="LoginUsuariosError"><?PHP form_error('nombre');?></div>
    </div>      
    <div class="fila">
        <div class="LoginUsuariosCabecera">E-Mail</div>
        <div class="LoginUsuariosDato"><input type="text" name="correo" value="<?PHP set_value('correo'); ?>" size="30" /></div>
        <div class="LoginUsuariosError"><?PHP form_error('correo');?></div>
    </div> 
    <div class="fila">
        <input type="submit" value="Registrar">
        
    </div>        
</div>
<p>&nbsp;</p>    
<p>&nbsp;</p>    
</form>
                
                
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