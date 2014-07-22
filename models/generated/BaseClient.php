<?php

/**
 * BaseClient
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $Nom
 * @property string $Prenom
 * @property string $Mail
 * @property string $Tel
 * @property string $Commentaire
 * @property Doctrine_Collection $FactureClient
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseClient extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('Client');
        $this->hasColumn('Nom', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('Prenom', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('Mail', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('Tel', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('Commentaire', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Facture as FactureClient', array(
             'local' => 'id',
             'foreign' => 'IdClient'));

        $searchable0 = new Doctrine_Template_Searchable(array(
             'fields' => 
             array(
              0 => 'id',
              1 => 'Nom',
              2 => 'Prenom',
              3 => 'Mail',
              4 => 'Tel',
             ),
             ));
        $this->actAs($searchable0);
    }
}