<?php

use Doctrine\ORM\Query\ResultSetMapping;

// Inclusion de la classe propositionVoyage
require_once "propositionVoyage.class.php";

class propositionVoyageTable {

        //permet de récupérer les elements de la table (sans colonne id) pour un id
        //$arr est un array(int,Voyage,Voyage), retourne un array(Voyage,Voyage)
        private static function getElementsById($arr,$id)
        {
                if($arr==null)     return null;
                $res=array();
                foreach($arr as $e)
                {
                        if($e[0]==$id)
                                $res[]=array(e[1],e[2]);
                }
                                
                return $res;
        }

        //Trouve l'element (Voyage,Voyage) ou element[1]==$corresp 
        //$arr est un array(Voyage,Voyage), retourne un element (Voyage,Voyage)
        private static function findByCorresp($arr,$corresp)
        {
                if($arr==null)  return null;
                foreach($arr as $e)
                {
                        if($e[1]==$corresp)
                                return $e;
                }
                return null;
        }

        //tableProposition est une array(Voyage,Voyage), retourne une Proposition
        private static function tablePropositionToProposition($tableProposition)
        {
                if($tableArr==null)     return null;
                $res=new propositionVoyage(array());
                $prochainElement=null;
                do{
                        $v=findByCorresp($tableProposition,$prochainElement);
                        //prepend $v dans $res
                        array_unshift($res,$v);
                        $prochainElement=$v[0].id;
                }while(findByCorresp($tableProposition,$prochainElement)!=null);
        }

        //$arr est un array(int,Voyage,Voyage) retourne un int
        private static function getIdPropMax($arr)
        {
                if($arr==null)  return null;
                $max=1;
                foreach($arr as $e)
                {
                        if($e[0]>$max)
                                $max=$e[0];
                }
                return $max;
        }

        //$tableArr est un array(int,Voyage,Voyage), retourne un array(Proposition) dans  l'ordre 1,2,3...
        private static function tableToArrayOfPropositions($tableArr)
        {
                $propositions=array();
              $nbDePropositions=getIdPropMax($tableArr);
              for($i=1;$i<=$nbDePropositions;$i++)
              {
                $propositions[]=new propositionVoyage(tablePropositionToProposition(getElementsById($tableArr,$i)));
              }
              return $propositions;
        }

        public static function getPropositionsVoyageByDepartArriveNbplacesHeuredepart($depart,$arrivee,$nbplaces,$heuredepart)
        {
                $em = dbconnection::getInstance()->getEntityManager() ;
                if($em == null)
                        return 'Erreur : La connection à la BDD a échouée';
                        
                $rsm = new ResultSetMapping();
                $rsm->addEntityResult('voyage', 'v');
                $rsm->addFieldResult('v', 'id_voyage', 'id_voyage');
                $rsm->addFieldResult('v', 'corresp', 'corresp');

                $query = $entityManager->createNativeQuery('SELECT id_proposition_voyage,id_voyage,corres FROM rechercherVoyages_demo(?,?,?,?)', $rsm);
                $query->setParameter(1, $depart);
                $query->setParameter(2, $arrivee);
                $query->setParameter(3, $nbplaces);
                $query->setParameter(4, $heuredepart);

                // return un array(int,Voyage,Voyage)
                $res = $query->getResult();
                
                // return $propositionsVoyage;

                // return un array de Propositions
                return tableToArrayOfPropositions($res);
        }
}
?>
