<?php

namespace Application\ChiaBundle\Form;

use Symfony\Component\Form\ChoiceField;

class CountryField extends ChoiceField
{
    public function __construct($key, array $options = array())
    {
        $data = unserialize(file_get_contents(__DIR__.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'es.dat'));
        $countries = $data['Countries'];
        foreach ($countries as $idx => $country) {
            if (is_numeric($idx)) unset($countries[$idx]);
            else break;
        }
        if (!isset($options['choices'])) $options['choices'] = $countries;
        if (!isset($options['preferred_choices'])) $options['preferred_choices'] = array('US', 'MX', 'CA');
        if (!isset($options['empty_value'])) $options['empty_value'] = 'Choose a country...';

        parent::__construct($key, $options);
    }

    public function getSeparator()
    {
        return $this->getOption('separator');
    }
}
