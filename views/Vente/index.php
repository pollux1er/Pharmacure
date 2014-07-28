<script type="text/javascript">
    $(document).ready( function () {
       $('#data_source_panier').DataTable( {
        
        language: {
        processing:     "Traitement en cours...",
        search:         "Rechercher&nbsp;:",
        lengthMenu:    "    _MENU_ Affichage  par page",
        info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
        infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
        infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
        infoPostFix:    "",
        loadingRecords: "Chargement en cours...",
        zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
        emptyTable:     "Aucune donnée disponible dans le tableau",
        paginate: {
            first:      "Premier",
            previous:   "Pr&eacute;c&eacute;dent",
            next:       "Suivant",
            last:       "Dernier"
        },
        aria: {
            sortAscending:  ": activer pour trier la colonne par ordre croissant",
            sortDescending: ": activer pour trier la colonne par ordre décroissant"
        }
    },
    "serverSide": false, //Ne pas mettre sur true, cela break la pagination
        "ajax":"afficherPanier",
         "columns": [
            { "data": "id" },
            { "data": "Libelle" },
            { "data": "Prix" },
            { "data": "Quantite" }
        ],
        scrollY: 400,
        "columnDefs": [
            {
                "title": "Quantite",
                "targets": [ 3 ],
                "visible": true,
                "searchable": false,
                "mRender": function (data, type, full) {
                return '<input type="number" value='+ full["Quantite"] +'  id="majQuantite/'+full["id"]+'">';
    }
            },
            {
                "targets": [ 0 ],
                "visible": false
            }
        ]
//        "Paginate":true, // Pagination True 
//        "PaginationType":"full_numbers", // And its type.
//         "iDisplayLength": 10
       
        } );
    } );

jQuery(document).ready(function($){
    
    
    /* Bind events form submit */
    //$('#produit').change( function(event){ submitForm(); });
    $('#classe').change(    function(event){ submitForm(); });
    $('#produit').change(    function(event){ submitForm(); });
    $('#produit').keyup(    function(event){ submitForm(); });
    //$('.ajoutPanier').onclick(    function(event){ submitForm(); });

    $('#formRecherche').submit(function(e){
        // On désactive le comportement par défaut du navigateur
        // (qui consiste à appeler la page action du formulaire)
        e.preventDefault();
    });
});


function submitForm(){
        
        // On désactive le comportement par défaut du navigateur
        // (qui consiste à appeler la page action du formulaire)
        //e.preventDefault();
                $.ajax({
                type: "POST",
                url: $("#formRecherche").attr('action'),
                data: $("#formRecherche").serialize(),
                dataType: 'html',
                success: function(data) {
                    $('#retour').html('');
                    $("#retour").append(data);
                    $('#retour').fadeIn();                            
                }
            });
    }



function panierAjout(id){
    $('#produit').blur();
	$.ajax({
                    type : "POST",
                    url: id,
                    data: $(this).serialize(),
                    success : function(data){
                        
                        if(data == 'success'){ 
                           //$("#data_source_panier").ajax.url( 'afficherPanier' ).load();
                           //$("#data_source_panier").DataTable().ajax.reload();
                           //AfficherPanier();
                           //alert("badi");
                           //$(this).removeAttr("href"); 
                           submitForm();
                           AfficherPanier(); 
                        }
                       },
                    error: function(){
                        alert("Erreur d'appel, le formulaire ne peut pas fonctionner");
                    }
                });
}

function AfficherPanier(){
    $.ajax({
                    type : "POST",
                    url: 'afficherPanier',
                    data: $(this).serialize(),
                    success : function(data){
                            $('#retourPanier').html('');
                            $("#retourPanier").append(data);
                            $('#retourPanier').fadeIn();
                       },
                    error: function(){
                        alert("Erreur d'appel, le formulaire ne peut pas fonctionner");
                    }
                });
}

$('.ajoutPanier').click(function(event){
  event.preventDefault();
});

function viderPanier(){
	$.ajax({
                    type : "POST",
                    url: 'creationPanier',
                    data: $(this).serialize(),
                    success : function(data){
                            AfficherPanier();
                            submitForm();
                       },
                    error: function(){
                        alert("Erreur d'appel, le formulaire ne peut pas fonctionner");
                    }
                });   
}

function panierSupprimer(id){
    $.ajax({
                    type : "POST",
                    url: id,
                    data: $(this).serialize(),
                    success : function(data){
                            AfficherPanier();
                            submitForm();
                       },
                    error: function(){
                        alert("Erreur d'appel, le formulaire ne peut pas fonctionner");
                    }
                });   
}

</script>
<div id="sales_dash">
        <div class="sales_step step_1" id="step_1"><span>1</span></div>
        <div class="sales_step step_2" id="step_2"><span>2</span></div>
        <div class="sales_step step_3" id="step_3"><span>3</span></div>
        <div class="sales_step step_4" id="step_4"><span>4</span></div>
        <div class="sales_step step_5" id="step_5"><span>5</span></div>
        <hr class="bar" id="line_1"></hr>
        <hr class="bar" id="line_2"></hr>
        <hr class="bar" id="line_3"></hr>
        <hr class="bar" id="line_4"></hr>
</div>
<div class="category">
    <span class="category_title">Choisissez les produits</span>
    <div class="sub_category">
        <form id="formRecherche" action="<?=WEBROOT?>Vente/rechercher" method="post">
			<font color="black" size="4">
				<table  border="0px" width="600px">
					<tr>
						<td width="100px" align="left">Medicament</td>	<td align="center"><input type="text"  id="produit" name="produit" placeholder="Libelle du medicament">	</td>
					</tr>
					<!--
					<tr>
						<td width="100px" align="left">Type</td>	<td align="center"><input type="text" id ="classe" name="classe" placeholder="Classe pharmaceutique">	</td>
					</tr>
					!-->
					<tr>
						<div id="retour">
						<i></i>
						</div>
					</tr>
				</table>
			</font>
		</form>
    </div>
</div>

<div class="category">
    <span class="category_title">Finalisez votre vente</span>
    <div class="sub_category">
  <a href="#" onclick="viderPanier()">Vider le panier</a>
  <div id="retourPanier">
    <i></i>
    <table id="sale_table" width="600px" >
        <tr><th>Action</th><th>Code Barre</th><th>Article</th><th>prix</th></tr>
    </table>
    <div style="height:100px;overflow:auto;">
    <table id="sale_table" width="600px">
    <?php if(isset($_SESSION['panier'])) : ?>
        <?php foreach($_SESSION['panier'] as $article) : ?>
            <tr >
                <td align="center">
                <a href="#" class="ajoutPanier" id="supprimerArticle/<?=$article->id?>" onclick="panierSupprimer(this.id);" >Supprimer</a>
                </td>
                <td align="center">
                    <?=$article->CodeBarre?>
                </td>
                <td align="center"><?=$article->Produit->Libelle?></td>
                <td align="center" style=" border-top-style:solid;border-top-width:1px;"><?=$article->Produit->Prix?></td>
                </tr>
        <?php endforeach;?>
    <?php endif; ?>                     
    </table>
    </div>
    <input type="submit" name="Valider" value="Valider" id="send"/>
  </div>
</div>
</div> 
<!-- 
<table id="sale_table" width="600px" >
 	<tr width="100%"><th>Id</th><th>Article</th><th>prix</th>  <th width="15px">Quantité</th></tr>
 	<tr ><td align="center">4563</td><td align="center">Article 1</td><td style="border-right-style:hidden;" align="right">350 CFA</td>  <td align="center" style=" border-top-style:solid;border-top-width:1px;">x1</td></tr>
 	<tr ><td align="center">7364</td><td align="center">Article 2</td><td style="border-right-style:hidden;" align="right">1 5000 CFA</td>  <td align="center">x2</td></tr>
 	<tr ><td align="center">9034</td><td align="center">Article 3</td><td style="border-right-style:hidden;" align="right">2 0000 CFA</td>  <td align="center">x2</td></tr>
 	<tr ><td align="center">8374</td><td align="center">Article 4</td><td style="border-right-style:hidden;" align="right">200 CFA</td>  <td align="center">x5</td></tr>
</table>
!-->