<?php
/**
 * Created by PhpStorm.
 * User: Alaa
 * Date: 22/03/2018
 * Time: 23:07
 */

namespace CupCake\UserBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseProfileFormType;

class ProfileFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('num_tel')
            ->add('nom')
            ->add('prenom')
            ->add('date_naissance')
            ->add('adresse')
            ->add('sexe',ChoiceType::class,array(
                'choices'=> array('Homme'=>'homme','Femme'=>'femme'),
                'expanded'=>true,
                'multiple'=>false,
                'label'=>'Sexe'
            ))
            ->add('image',HiddenType::class)
            ->add('roles',ChoiceType::class,array(
                'choices'=> array(
                    'Client'=> 'ROLE_CLIENT',
                    'Patissier'=> 'ROLE_PATISSIER'
                ),
                'expanded'=>true,
                'multiple'=>true,
                'label'=>'roles'
            ));
    }

    public function getParent()
    {
        return BaseProfileFormType::class;
    }
}