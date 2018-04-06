<?php

namespace CupCake\PatisserieBundle\Form;

use CupCake\UserBundle\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AjoutPatisserieFormType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle_patisserie')
            ->add('adresse_patisserie')
            ->add('date_creation')
            ->add('specialite')
            ->add('compte_facebook',UrlType::class)
            ->add('compte_instagram',UrlType::class)
            ->add('description',TextareaType::class)
            ->add('image',HiddenType::class)
//            ->add('id_utilisateur',HiddenType::class)
            ->add('save',SubmitType::class,array(
                'attr'=>array('class'=> 'btn btn-danger')
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CupCake\PatisserieBundle\Entity\Patisserie'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'cupcake_patisseriebundle_patisserie';
    }


}
