<?php 

namespace App\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class StringToDateTimeImmutableTransformer implements DataTransformerInterface
{
    public function transform($value)
    {
        if (null === $value) {
            return '';
        }

        if (!$value instanceof \DateTimeImmutable) {
            throw new TransformationFailedException('Expected a DateTimeImmutable.');
        }

        return $value->format('Y-m-d'); // Format adapté à votre besoin
    }

    public function reverseTransform($value)
    {
        if (null === $value) {
            return null;
        }

        try {
            return new \DateTimeImmutable($value);
        } catch (\Exception $e) {
            throw new TransformationFailedException('Invalid date format.');
        }
    }
}
