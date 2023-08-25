<?php 

namespace App\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use App\Repository\GendersRepository;

class GenderTransformer implements DataTransformerInterface
{
    private $repository;

    public function __construct(GendersRepository $repository)
    {
        $this->repository = $repository;
    }

    public function transform($value)
    {
        return $value;
    }

    public function reverseTransform($value)
    {
        if($value == null){
            return null;
        }

        return $this->repository->find($value);
    }
}