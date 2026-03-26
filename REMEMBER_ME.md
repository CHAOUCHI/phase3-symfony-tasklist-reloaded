## Important Symfony concept 

- CSS Block : Utile pour ecrire du css à la main sur la page, il vaut mieux utilisé tailwind mais dans certain cas comme les formBuilder de symfony, il est plus simple d'utiliser du css à la main pour styliser les éléments.
```php
{% block stylesheets %}
    <style>
        .form-control {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
{% endblock %}
```

- `tailwind build --watch` : Permet de compiler le css de tailwind en temps réel, il faut lancer cette commande dans le terminal au démarrage de votre VSCode pour que les changements soient pris en compte quand vous codez votre application.

- FormBuilder Attribute : Permet de définir entre autres les attributs HTML d'un champ de formulaire, comme la classe CSS, le placeholder, etc...
```php
<?php

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', null, [ 
                'required' => true,     // Le champ est obligatoire
                'attr' => [             // Attributs HTML pour le champ
                    'placeholder' => 'votre@email.com',
                ],
            ])
            ->add('username', null, [
                'required' => true,     // Le champ est obligatoire
                'attr' => [             // Attributs HTML pour le champ
                    'placeholder' => 'nom_utilisateur',
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue(
                        message: 'You should agree to our terms.',
                    ),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'placeholder' => '************',
                    ],
                'constraints' => [
                    new NotBlank(
                        message: 'Please enter a password',
                    ),
                    new Length(
                        min: 6,
                        minMessage: 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        max: 4096,
                    ),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
```

- Ecrire un href : Utilisez la fonction `path()` dans votre template twig
```html
<a href="{{ path('app_login') }}">Login</a>
```

- Twig Component :
*installation*
```
compose require symfony/ux-twig-component
```
*création d'un component réutilisable*
``` 
symfony console make:twig-component IconButton
```

- J'ai oublier les commandes `symfony console`
```bash
symfony console list
```


## Comment lire la documentation de Symfony

- Symfony Docs : Le style FAQ est très pédagogique, il explique les concepts de manière simple et claire, avec des exemples concrets. **ATTENTION UTILISEZ LE SOMMAIRES SINON VOUS ALLEZ JAMAIS** : https://symfony.com/doc

- Symfony Réference : Liste exhaustive de toutes paramètres des fichiers yaml, des fonctions, etc... C'est plus technique et moins pédagogique que la documentation mais c'est très utilile pour ne pas cherche sur google la syntaxe d'un paramètre ou d'une fonction : https://symfony.com/doc/current/reference/index.html

