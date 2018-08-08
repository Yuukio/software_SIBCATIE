

<div class='col-xsa-5 col-sma-5 col-mda-5 col-lga-5' style='padding: 10px; padding-top: 20px'>
    <div style='height: 100%; width: 100%'>
        <div class='card mb-4 box-shadow'>
            <img class='card-img-top' data-src='holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail' alt='Thumbnail [100%x100%]' style='width: 100%; display: block;' src='app/" + item.url_img + "' data-holder-rendered='true'>
            <div class='card-body' style='text-align: center'>
                <div style='text-align: left; margin-bottom: 5px'>
                    <h6>" + item.nombre_genero + "</h6><p style='margin-bottom: 0px;'><i>" + item.nombre_epiteto + "</i></p></div><div style='text-align: right; margin-bottom: 10px'><small class='text-muted'>ID -" + item.idMascara + "</small></div><div class='justify-content-between align-items-center'><div class='btn-group' style='text-align: center;'><button type='button' class='btn btn-sm btn-info'><a href='http://localhost/software_SIBCATIE/ver-especie.php?id=" + item.idPlanta + "' style='color: white; text-decoration: none; padding: 6px 0px 6px 0px'>Ver</a></button><button type='button' class='btn btn-sm btn-outline-secondary' onclick='guardarFavorito('" + item.idPlanta + "')'>Guardar</button><button type='button' class='btn btn-sm btn-outline-secondary' onclick='guardarExportar('" + item.idPlanta + "')'>Exportar</button></div></div></div></div></div></div>







<div class='col-xsa-5 col-sma-5 col-mda-5 col-lga-5' style='padding: 10px; padding-top: 20px'><div style='height: 100%; width: 100%'><div class='card mb-4 box-shadow'><img class='card-img-top' data-src='holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail' alt='Thumbnail [100%x100%]' style='width: 100%; display: block;' src='app/" + item.url_img + "' data-holder-rendered='true'><div class='card-body' style='text-align: center'><div style='text-align: left; margin-bottom: 5px'><h6>"+item.nombre_genero+"</h6><p style='margin-bottom: 0px;'><i>"+item.nombre_epiteto+"</i></p></div><div style='text-align: right; margin-bottom: 10px'><small class='text-muted'>ID - "+item.idMascara+"</small></div><div class='justify-content-between align-items-center'><div class='btn-group' style='text-align: center;'><button type='button' class='btn btn-sm btn-info'><a href='http://localhost/software_SIBCATIE/ver-especie.php?id="+item.idPlanta+"' style='color: white; text-decoration: none; padding: 6px 0px 6px 0px'>Ver</a></button><form><button type='button' class='btn btn-sm btn-outline-secondary' id='guardar' onclick='guardarFavorito('"+item.idPlanta+"')"+"+">Guardar</button><button type='button' class='btn btn-sm btn-outline-secondary' id='exportar' onclick='guardarExportar('"+item.idPlanta+"')'>Exportar</button></form></div></div></div></div></div></div>