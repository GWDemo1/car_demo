<?php
namespace App\Form\Type;


class AnimalType extends AbstractType{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>Animal::class
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name',TextType::class)
        ->add('birthday',DateTimeType::class,['widget'=>'single_text'])
        ->add('email',EmailType::class)
        ->add('weight',TextType::class)
        ->add('cat',EntityType::class,[
            'class' => CatAni::class,
            'choice_label' => 'name'
        ])
      
        ->add('save',SubmitType::class,[
            'label' => 'Save'
        ]);
    }
}

?>