<?php

namespace App\Form;

use App\Entity\Folder;
use App\Entity\Priority;
use App\Entity\Task;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'label' => 'Titre de la tâche',
                'attr'  => [
                    'placeholder' => 'Ex: Faire les courses',
                    'class'       => 'w-full bg-[#F3F3F5] p-2',
                ]
            ])
            ->add('priority', EntityType::class, [
                'class'        => Priority::class,
                'choice_label' => 'level',
                'label'        => 'Priorité',
                'required'     => false,
                'placeholder'  => 'Sélectionner une priorité',
                'attr'         => [
                    'class' => 'w-full bg-[#F3F3F5] p-2',
                ]
            ])
            ->add('folder', EntityType::class, [
                'class'        => Folder::class,
                'choice_label' => 'name',
                'label'        => 'Dossier (optionnel)',
                'required'     => false,
                'placeholder'  => 'Sélectionner un dossier',
                'attr'         => [
                    'class' => 'w-full bg-[#F3F3F5] p-2 mb-4',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}