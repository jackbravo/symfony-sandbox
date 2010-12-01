<?php

namespace Application\ChiaBundle\Form\ValueTransformer;

use Symfony\Component\Form\ValueTransformer\BaseValueTransformer;
use Symfony\Component\Form\ValueTransformer\TransformationFailedException;

class CollectionToGroupTransformer extends BaseValueTransformer
{
    protected function configure()
    {
        $this->addOption('create_instance_callback', null); // this method must manage the associations
        $this->addOption('remove_instance_callback', null); // this method must manage the associations
        $this->addRequiredOption('em');
        $this->addRequiredOption('fields', array());
        $this->addRequiredOption('className');

        parent::configure();
    }

    /**
     * @param array $data
     * @param Collection $collection
     */
    public function reverseTransform($data, $collection)
    {
        $data = $this->clearData($data);

        if (count($data) == 0) {
            // don't check for collection count, a straight clear doesnt initialize the collection
            $collection->clear();
            return $collection;
        }

        $remove_callback = $this->getOption('remove_instance_callback');
        foreach ($collection as $key => $object) {
            if (!array_key_exists($key, $data)) {
                call_user_func($remove_callback, $object);
            } else {
                $this->fromArray($data[$key], $object);
                unset($data[$key]);
            }
        }

        // only new values are left
        $metadata = $this->getOption('em')->getClassMetadata($this->getOption('className'));
        $create_callback = $this->getOption('create_instance_callback');
        foreach ($data as $key => $value) {
            if (empty($value)) continue; // fix issue with bind method on Field and FieldGroup
            $newObject = call_user_func($create_callback);
            $this->fromArray($value, $newObject);
        }
        return $collection;
    }

    /**
     * @param Collection $collection
     */
    public function transform($collection)
    {
        $data = array();
        foreach ($collection as $key => $object) {
            $data[$key] = $this->toArray($object);
        }
        return $data;
    }

    public function toArray($object)
    {
        $metadata = $this->getOption('em')->getClassMetadata($this->getOption('className'));
        $properties = $metadata->getReflectionProperties();
        $fields = $this->getOption('fields');

        $data = array();
        foreach ($fields as $fieldName) {
            if (is_object($properties[$fieldName]->getValue($object))) continue;
            $data[$fieldName] = $properties[$fieldName]->getValue($object);
        }
        return $data;
    }

    public function fromArray($data, $object)
    {
        $metadata = $this->getOption('em')->getClassMetadata($this->getOption('className'));
        $properties = $metadata->getReflectionProperties();
        $fields = $this->getOption('fields');

        foreach ($fields as $fieldName) {
            if (empty($data[$fieldName])) continue;
            $properties[$fieldName]->setValue($object, $data[$fieldName]);
        }
        return $data;
    }

    public function clearData($data)
    {
        $fields = $this->getOption('fields');

        foreach ($data as $key => $value) {
            $has_data = false;
            foreach ($fields as $fieldName) {
                if (!empty($value[$fieldName])) {
                    $has_data = true;
                    break;
                }
            }
            if (!$has_data) {
                unset($data[$key]);
            }
        }
        return $data;
    }
}
