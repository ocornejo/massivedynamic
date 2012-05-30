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
	float:left;
	background-color: #1D9995;
	width:130px;
	height:20px;
	border-color:#FFFFFF;
	border-width:thin;
	border-style:solid;
}

.LoginUsuariosDato{
	float:left;	
	background-color: #C3E9DA;
	width:200px;
	height:20px;
	border-color:#FFFFFF;
	border-width:1px;
	border-style:solid;
}
.LoginUsuariosError{
	float:left;
	width:400px;
	height:20px;
	color:#FF0000;
}

.LoginUsuariosError p{
	vertical-align:top;
	margin-top:3px;
	margin-left:3px;
}
</style>

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
    
    <div id="container">
        <section id="intro">
            <center>
            <?php echo  form_open('controller_login/login'); ?>
<div class="Info">
    <p class="Titulo">Por su seguridad, requerimos sus datos de acceso</p>
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
        <div class="LoginUsuariosCabecera"></div>
        <div class="LoginUsuariosDato"></div>
    </div>        
    <div class="fila">
        <div class="LoginUsuariosCabecera"><input type="submit" value="Ingresar"></div>
        <div class="LoginUsuariosDato"></div>
    </div>        
</div>
<p>&nbsp;</p>    
<p>&nbsp;</p>    
</form>
            </center>
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