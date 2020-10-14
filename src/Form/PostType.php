<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Posts;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category',ChoiceType::class, [
                'choice_label' => [ ChoiceList::attr($this,function (?Categories $categories){
                    return $categories ? ['data-uuid'=>$categories->getTitle()]: [];
                })
                ]
            ])
            ->add('name',TextType::class,[
                'attr'=> [
                    'placeholder' => 'Type the title..'
                ]
            ])
            ->add('body', TextareaType::class,[
                'attr' => [
                    'placeholder' => 'Type the content..'
                ],
            ])
            ->add('submit',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Posts::class,
        ]);
    }
}
