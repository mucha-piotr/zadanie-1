<?php
/**
 * Created by PhpStorm.
 * User: muszkin
 * Date: 17.09.2017
 * Time: 09:58
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SetupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("year",ChoiceType::class,[
                "choices" => $this->buildDates(),
                "attr" => [
                    "placeholder" => "2021",
                ],
                "required" => false,
                "empty_data" => "2021"
            ])
            ->add("day",ChoiceType::class,[
                "choices" => [
                    "Poniedziałek" => 1,
                    "Wtorek" => 2,
                    "Środa" => 3,
                    "Czwartek" => 4,
                    "Piątek" => 5,
                    "Sobota" => 6,
                    "Niedziela" => 0
                ],
                "attr" => [
                    "placeholder" => "5"
                ],
                "required" => false,
                "empty_data" => "5"
            ])
            ->add("format",TextType::class,[
                "attr" => [
                    "placeholder" => "d-m-Y"
                ],
                "required" => false,
                "empty_data" => "d-m-Y"
            ])
            ->add("mode",ChoiceType::class,[
                "choices" => [
                    "Parzyste" => 1,
                    "Nieparzyste" => 0,
                ],
                "attr" => [
                    "placeholder" => "Parzyste"
                ],
                "required" => false,
                "empty_data" => "1"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => null
        ]);
    }

    public function buildDates()
    {
        $distance = 10;
        $yearsBefore = date('Y', mktime(0, 0, 0, date("m"), date("d"), date("Y") - $distance));
        $yearsAfter = date('Y', mktime(0, 0, 0, date("m"), date("d"), date("Y") + $distance));
        return array_combine(range($yearsBefore, $yearsAfter), range($yearsBefore, $yearsAfter));
    }
}