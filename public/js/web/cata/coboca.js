$(document).ready(function(){
	$("#tbDatos").DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
		order: [[ 2, 'desc' ]]
	});

});

var obj = {
	openModal: function(id){
		$('#modal_large').modal();
        $.ajax({
            type: 'get',
            url: "evento/"+id,
            success: function(data) {
            	aDatos = data.aDatos;
                // aImages = data.aImages;
                // console.log(aDatos)
                let alert = "";
                alert  = "<div class=\"alert alert-danger alert-styled-left alert-bordered\">";
                alert += "  <span class=\"text-semibold\">Advertencia!</span> No se encontraron imagenes para la galeria seleccionada.";
                alert += "</div>";

            	var html = "";

            	html += "<div class=\"row\">";
            	html += "	<div class=\"col-md-4\"><span class=\"help-block text-semibold\">C&oacute;digo</span>"+aDatos.iCodEvento+"</div>";
            	html += "	<div class=\"col-md-4\"><span class=\"help-block text-semibold\">Estatus</span>"+aDatos.Estatus+"</div>";
            	html += "</div>";

                html += "<div class=\"row\">";
                html += "   <div class=\"col-md-4\"><span class=\"help-block text-semibold\">Nombre</span>"+aDatos.tNombre+"</div>";
                html += "   <div class=\"col-md-4\"><span class=\"help-block text-semibold\">Comentarios</span>"+aDatos.tComentarios+"</div>";
                html += "</div>";
                html += "<div class=\"row\">";
                html += "   <div class=\"col-md-4\"><span class=\"help-block text-semibold text-info\">Mostrar Galeria</span>"+(aDatos.bMostrar == 1 ? 'Si' : 'No')+"</div>";
                html += "</div>";

                html += "<div class=\"row\">";
                html += "   <div class=\"col-md-12\"><hr></div>";
                html += "</div>";

                html += "<div class=\"row\">";
                html += "    <div class=\"col-lg-3 col-sm-6\">";
                html += "        <div class=\"thumbnail\">";
                html += "            <div class=\"thumb\">";
                html += "                <img src=\""+aDatos.tArchivo+"\" alt=\"\">";
                html += "            </div>";
                html += "        </div>";
                html += "    </div>";
                html += "</div>";

                $(".modal-body").html(html);
            }
        });

	}
}