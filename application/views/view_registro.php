<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Massive Dynamics, La mejor tienda virtual de Software de este universo y algunos otros</title>
<?php// include('rutas_config.php')?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="<?php echo $ruta_estilos ?>estilo_login.css" type="text/css" media="screen">
<!--<link rel="stylesheet" href="../../php-login.css" type="text/css" media="screen">-->
</head>
 
<body style="margin-top:0px">
<?php echo  form_open('controller_registro/registrar'); ?>
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
        <div class="LoginUsuariosDato"><input type="password" name="passwordlogin" value="<?PHP set_value('passwordlogin'); ?>" size="255" /></div>
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
        <div class="LoginUsuariosCabecera"><input type="submit" value="Registrar"></div>
        <div class="LoginUsuariosDato"></div>
    </div>        
</div>
<p>&nbsp;</p>    
<p>&nbsp;</p>    
</form>
</body>
</html>