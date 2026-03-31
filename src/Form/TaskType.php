<?php

namespace App\Form;

use App\Entity\Folder;
use App\Entity\Priority;
use App\Entity\Task;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',null,[
                "label"=>"Titre de la tâche"
            ])
            ->add('priority', EntityType::class, [
                'class' => Priority::class,
                "label"=>"Priorité",
                'choice_label' => 'level',
            ])
            // ->add('status')
            // ->add('user', EntityType::class, [
            //     'class' => User::class,
            //     'choice_label' => 'id',
            // ])
            ->add('folder', EntityType::class, [
                'class' => Folder::class,
                'choice_label' => 'name',
                "label"=>"Dossier(optionnel)"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
