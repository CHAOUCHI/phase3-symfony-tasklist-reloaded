<?php

namespace App\Form;

use App\Entity\Folder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class FolderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label'       => 'Nom du dossier',
                'constraints' => [new NotBlank(message: 'Le nom est obligatoire')],
                'attr'        => ['placeholder' => 'Ex: Travail, Personnel...'],
            ])
            ->add('color', ColorType::class, [
                'label'    => 'Couleur',
                'required' => false,
                'data'     => '#22c55e',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Folder::class,
        ]);
    }
}
