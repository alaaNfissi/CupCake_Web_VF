<?php

namespace CupCake\StatistiqueBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\CalendarChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\Material\ColumnChart;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\Validator\Constraints\DateTime;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em=$this->getDoctrine()->getManager();
        $patisserie=$em->getRepository('PatisserieBundle:Patisserie')->findOneBy(array('utilisateur'=>$this->getUser()));
        if($patisserie == null)
        {
            $nbreCommandes=null;
            $commandes=array();
        }
        else
        {
            $nbreCommandes=$em->getRepository('CommandeBundle:Commande')->numCommande($patisserie);
            $commandes=$em->getRepository('CommandeBundle:Commande')->listCommandes($patisserie->getIdPatisserie());
        }
//        $nbreCommandes=$em->getRepository('CommandeBundle:Commande')->numCommande($patisserie);
//        $commandes=$em->getRepository('CommandeBundle:Commande')->listCommandes($patisserie->getIdPatisserie());
        $chart = new ColumnChart();
//        $data=array('N° Commande','Prix Totale en Millimes');
        $dataSet=array(['N° Commande','Prix Totale en Millimes']);
        $dataSetCal=array([['label' => 'Date', 'type' => 'date'], ['label' => 'Attendance', 'type' => 'number']]);

        for($i=0;$i<count($commandes);$i++)
        {
            $RCTotale=$em->getRepository('CommandeBundle:Commande')->revenueDesCommandeDate($patisserie,$commandes[$i]->getDateCommande());
            array_push($dataSet,[$commandes[$i]->getNumCommande(),$commandes[$i]->getPrixTotale()*1000]);
            array_push($dataSetCal,[ new \DateTime($commandes[$i]->getDateCommande()), $RCTotale ]);
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


//        ------------------------------------------------------------------------------------------------------------------------------------------

        $cal = new CalendarChart();
        $cal->getData()->setArrayToDataTable($dataSetCal);
//            [
//                [['label' => 'Date', 'type' => 'date'], ['label' => 'Attendance', 'type' => 'number']],
//                [ new \DateTime('2012-03-14'), 37032 ],
//                [ new \DateTime('2012-03-14'), 38024 ],
//                [ new \DateTime('2012-03-15'), 38024 ],
//                [ new \DateTime('2012-03-16'), 38108 ],
//                [ new \DateTime('2012-03-17'), 38229 ],
//                [ new \DateTime('2012-03-18'), 38177 ],
//                [ new \DateTime('2012-03-19'), 38705 ],
//                [ new \DateTime('2012-03-20'), 38210 ],
//                [ new \DateTime('2012-03-21'), 38029 ],
//                [ new \DateTime('2012-03-22'), 38823 ],
//                [ new \DateTime('2012-03-23'), 38345 ],
//                [ new \DateTime('2012-03-24'), 38436 ],
//                [ new \DateTime('2012-03-25'), 38447 ]
//            ]
//        );
        $cal->getOptions()->setTitle('Vos Ventes');
        $cal->getOptions()->setHeight(500);
        $cal->getOptions()->setWidth(1000);
        $cal->getOptions()->getCalendar()->setCellSize(50);
        $cal->getOptions()->getCalendar()->getCellColor()->setStroke('#76a7fa');
        $cal->getOptions()->getCalendar()->getCellColor()->setStrokeOpacity(0.5);
        $cal->getOptions()->getCalendar()->getCellColor()->setStrokeWidth(1);
        $cal->getOptions()->getCalendar()->getFocusedCellColor()->setStroke('#d3362d');
        $cal->getOptions()->getCalendar()->getFocusedCellColor()->setStrokeOpacity(1);
        $cal->getOptions()->getCalendar()->getFocusedCellColor()->setStrokeWidth(1);
        $cal->getOptions()->getCalendar()->getDayOfWeekLabel()->setFontName('Times-Roman');
        $cal->getOptions()->getCalendar()->getDayOfWeekLabel()->setFontSize(12);
        $cal->getOptions()->getCalendar()->getDayOfWeekLabel()->setColor('#1a8763');
        $cal->getOptions()->getCalendar()->getDayOfWeekLabel()->setBold(true);
        $cal->getOptions()->getCalendar()->getDayOfWeekLabel()->setItalic(true);
        $cal->getOptions()->getCalendar()->setDayOfWeekRightSpace(10);
        $cal->getOptions()->getCalendar()->setDaysOfWeek('DLMMJVS');
        $cal->getOptions()->getCalendar()->getMonthLabel()->setFontName('Times-Roman');
        $cal->getOptions()->getCalendar()->getMonthLabel()->setFontSize(12);
        $cal->getOptions()->getCalendar()->getMonthLabel()->setColor('#981b48');
        $cal->getOptions()->getCalendar()->getMonthLabel()->setBold(true);
        $cal->getOptions()->getCalendar()->getMonthLabel()->setItalic(true);
        $cal->getOptions()->getCalendar()->getMonthOutlineColor()->setStroke('#981b48');
        $cal->getOptions()->getCalendar()->getMonthOutlineColor()->setStrokeOpacity(0.8);
        $cal->getOptions()->getCalendar()->getMonthOutlineColor()->setStrokeWidth(2);
        $cal->getOptions()->getCalendar()->getUnusedMonthOutlineColor()->setStroke('#bc5679');
        $cal->getOptions()->getCalendar()->getUnusedMonthOutlineColor()->setStrokeOpacity(0.8);
        $cal->getOptions()->getCalendar()->getUnusedMonthOutlineColor()->setStrokeWidth(1);
        $cal->getOptions()->getCalendar()->setUnderMonthSpace(16);
        $cal->getOptions()->getCalendar()->setUnderYearSpace(10);
        $cal->getOptions()->getCalendar()->getYearLabel()->setFontName('Times-Roman');
        $cal->getOptions()->getCalendar()->getYearLabel()->setFontSize(32);
        $cal->getOptions()->getCalendar()->getYearLabel()->setColor('#1A8763');
        $cal->getOptions()->getCalendar()->getYearLabel()->setBold(true);
        $cal->getOptions()->getCalendar()->getYearLabel()->setItalic(true);

//        ---------------------------------------------------------------------------------------------------------------------------------------
        return $this->render('StatistiqueBundle:Default:index.html.twig',array('barChart'=>$chart,'patisserie'=>$patisserie,'nbreCommandes'=>$nbreCommandes,'calendar_chart'=>$cal));
    }
}
