<?php

namespace App\Form;

use App\Entity\Tarefas;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TarefasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nome', TextType::class, ['label' => 'Nome da Tarefa'])
            ->add('descricao')
            ->add('prazo', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'dd/MM/yyyy', 
                'attr' => ['class' => 'datepicker'], 
                'required' => false,
                'invalid_message' => 'O formato da data está incorreto. Use o formato dd/MM/yyyy.', 
            ])
            ->add('prioridade', ChoiceType::class, [
                'choices' => [
                    'Alta' => 1,
                    'Média' => 2,
                    'Baixa' => 3,
                ],
                'placeholder' => 'Selecione a Prioridade',
            ])
            ->add('concluida', CheckboxType::class, ['required' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tarefas::class,
        ]);
    }
}



        
                
            
       
