<script type="text/javascript">
function addline(){
    var contenu = $(".ligneproduit").get()[0].outerHTML;
    $('.upper_content_forms_table').append(contenu);
    console.log(contenu);
    $('.upper_content_forms_table').children('div').css('display', 'true');
}
$(function(){
        $("#formCommande").submit(function(event){
            var etat        = $("#idetat").val();
                $.ajax({
                    type : "POST",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success : function(data){
                        
                        if(data == 'success'){
                            $('#OKText').html("Succ&egrave;s ! Votre commande a &eacute;t&eacute; modifié.");
                            $('#formOk').show();
                            $('#formKO').hide();
                            
                        }
                        else if(data == 'failed'){
                            $('#KOText').html("Erreur ! Cette commande n'est pas valide");
                            $('#formOk').hide();
                            $('#formKO').show();         
                        }else{
                            $('#KOText').html("Erreur ! La validation du formulaire à echouée");
                            $('#formOk').hide();
                            $('#formKO').show();
                        }
                        
                    },
                    error: function(){
                        $('#formKO').html("Erreur d'appel, le formulaire ne peut pas fonctionner");
                    }
                });
             return false;
            });
        });
</script>
<div id="upper_content_forms" style="visibility:visible !important;">
<div>
            <div style="display:none;" id="formOk" class="alert alert-icon alert-success">
                <div id="OKText" class="text">
                </div>
            </div>
            <div style="display:none;" id="formKO" class="alert alert-icon alert-danger">
                <div id="KOText" class="text">
                </div>
            </div>
</div>
<form id="formCommande" action="<?=WEBROOT?>Commandes/creation" method="post" >
    <input type="hidden" value='<?=$view["form"]["type"]?>' name="type">
    <input type="hidden" value='<?=$view["id"]?>' name="id">
    <font color="black" size="4">
        <table class="upper_content_forms_table" >
            <tr>
                <td width="42px" align="left">Etat</td>
                <td align="center">
                    <select id="idetat" style="width:90px; text-overflow: ellipsis;" name="idetat">
                        <?php foreach ($view['etat'] as $etats):?>
                            <option value="<?=$etats->id?>" <?php if($etats->id==$view['form']['idetat']) echo 'selected' ?>> <?=$etats->Libelle?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
        </table>
        <input type="submit" name="Modif_commande" value="Modifier" class="upper_content_forms_send"/>
        <input type="button" value="Ajouter Produit" onclick="addline()"class="upper_content_forms_send"/>
</form>
</div>
<div style="display:none;" class="ligneproduit">
                <tr>
                    <td width="42px" align="left">Produit</td>
                    <td align="center">
                    <select classe="idproduit" style="width:90px; text-overflow: ellipsis;" name="idproduit[]">
                        <?php foreach ($view['produit'] as $produit):?>
                            <option value="<?=$produit->id?>"> <?=$produit->Libelle?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td width="42px" align="left">Quantité</td>   
                <td align="center"><input classe="quantite" type="number" name="quantite[]"  placeholder="Quantité"></td>
                </tr>
            </div>

