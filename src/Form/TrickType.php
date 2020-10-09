<?php

namespace App\Form;

use App\Entity\Trick;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('trickgroup', ChoiceType::class, [
                'choices' => $this->getChoices(),
            ])
            ->add('picture')
            ->add('video')
            ->add('creation_date')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
            'translation_domain' => 'forms'
        ]);
    }

    public function getChoices(){
         $choices = Trick::groups;
         $output = [];
         foreach($choices as $k => $v){
             $output[$v] = $k;
         }
         return $output;
    }
}
