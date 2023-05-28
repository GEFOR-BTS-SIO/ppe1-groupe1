<?php
namespace App\Form;

use App\Entity\Formation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProfilFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cursus', ChoiceType::class, [
                'choices' => [
                    'Sio' => 'sio',
                    'Slam' => 'slam',
                    // Ajoutez d'autres options de filtrage en fonction de vos besoins
                ],
                'placeholder' => 'Tous les cursus',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configurez ici les options de résolution du formulaire, le cas échéant
        ]);
    }
}
?>
