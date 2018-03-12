<?php
// удалить этот класс
namespace CruiseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use CruiseBundle\Entity\Discount;

class OrderDiscountType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			//->add('type')
			//->add('plus')
			//->add('priority')
			//->add('value')

			//->add('enable',CheckboxType::class)
			->add('discountAdd',EntityType::class,[
				'class' => Discount::class,
				'choice_label' => 'name',
				'multiple' => true,
				'expanded' => true,
				'mapped' => false,				
			])
		;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CruiseBundle\Entity\OrderDiscount'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'cruisebundle_orderdiscount';
    }


}
