<form name='formulario' id='formulario' method='post' action='app/enviarConsulta.php' target='_self' enctype="multipart/form-data"> 
    <p>Nombre <input type='text' name='Nombre' id='Nombre'></p> 
    <p>E-mail 
        <input type='text' name='email' id='email'>
    </p>
    <p>Asunto 
        <input type='text' name='asunto' id='asunto' />
    </p>
    <p>Mensaje 
        <textarea name="mensaje" cols="50" rows="10" id="mensaje"></textarea>
    </p>
    <p>Adjuntar archivo: <input type='file' name='archivo1' id='archivo1'></p> 
    <p>
        <input type='submit' value='Enviar'> 
    </p> 
</form>