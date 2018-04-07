<?php

namespace CupCake\StatistiqueBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\Material\ColumnChart;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em=$this->getDoctrine()->getManager();
        $patisserie=$em->getRepository('PatisserieBundle:Patisserie')->findOneBy(array('utilisateur'=>$this->getUser()));
        $nbreCommandes=$em->getRepository('CommandeBundle:Commande')->numCommande($patisserie);
        $commandes=$em->getRepository('CommandeBundle:Commande')->listCommandes($patisserie->getIdPatisserie());
        $chart = new ColumnChart();
//        $data=array('N° Commande','Prix Totale en Millimes');
        $dataSet=array(['N° Commande','Prix Totale en Millimes']);

        for($i=0;$i<count($commandes);$i++)
        {
            array_push($dataSet,[$commandes[$i]->getNumCommande(),$commandes[$i]->getPrixTotale()*1000]);
        }
//        array_reverse($dataSet);
        dump($dataSet);
//        $chart->getData()->setArrayToDataTable([
//            ['Year', 'Sales'],
//            ['2014', 1000],
//            ['2015', 1170],
//            ['2016', 660],
//            ['2017', 1030]
//        ]);
        $chart->getData()->setArrayToDataTable($dataSet);
        $chart->getOptions()->getChart()
            ->setTitle('Performance de Votre Patisserie')
            ->setSubtitle('Prix totale en Millimes de chaque commande validée');
        $chart->getOptions()
            ->setBars('vertical')
            ->setHeight(500)
            ->setWidth(900)
            ->setColors(['#dc2365'])
            ->getVAxis()
            ->setFormat('decimal');
        return $this->render('StatistiqueBundle:Default:index.html.twig',array('barChart'=>$chart,'patisserie'=>$patisserie,'nbreCommandes'=>$nbreCommandes));
    }
}
