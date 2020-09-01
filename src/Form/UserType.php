<?php

namespace App\Form;

use App\Entity\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
{
    private $user;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->user = $options['data'];
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Login / eMail',
            ])
            ->add('disabled', CheckboxType::class, [
                'required' => false,
            ])
            ->add('roles', ChoiceType::class, [
                'required' => false,
                'expanded' => false,
                'multiple' => true,
                'choices' => [
                    'Administrateur' => 'ROLE_ADMIN',
                    'Utilisateur' => 'ROLE_USER'
                ],
                'empty_data' => 'ROLE_USER',
            ])
            ->add('plainPassword', TextType::class, [
                'label' => 'Password',
                'required' => false,
                'mapped' => false,
                'empty_data' => $this->user->getPassword()
            ])
            ->add('fullname', TextType::class, [
                'required' => false,
            ])
            ->add('nickname', TextType::class, [
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
