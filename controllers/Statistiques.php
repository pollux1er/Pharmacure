
<?php
 
class Statistiques extends Controller{


    /**
     * @UserS('REQUIRED')
     */
    function index(){

	$articles = new Article();
    $q = Doctrine_Query::create()->select("sum(p.prix) as CA,count(a.id) as vente,sum(p.prix-p.PrixAT) as marge")->from('Article a');
    $q = $q->leftJoin('a.Produit p');
    $q = $q->AndWhere('a.DateVente = DATE(NOW()');

    $req = $q->execute();

    echo $q->getSqlQuery();
    
    if ($req->toArray()[0]['CA'] == null) {
    	$today = array("CA"=> 0,"vente"=>$req->toArray()[0]['vente'],"marge"=>0);
    }else $today = array("CA"=> $req->toArray()[0]['CA'],"vente"=>$req->toArray()[0]['vente'],"marge"=>$req->toArray()[0]['marge']);

   	$q = Doctrine_Query::create()->select("sum(p.prix) as CA,count(a.id) as vente,sum(p.prix-p.PrixAT) as marge")->from('Article a');
    $q = $q->leftJoin('a.Produit p');
    $req = $q->execute();
    $since = array("CA"=> $req->toArray()[0]['CA'],"vente"=>$req->toArray()[0]['vente']);
    
    $d['view'] = array("since" => $since,"today" => $today);
    $this->set($d); 
    $this->render('index');
    }
}
?>