<?php

namespace App\Helpers;

use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class JsonResponseHelper
 *
 * Help controller to render json data, deal with circular and customized groups attributes
 */
class JsonResponseHelper
{
    /**
     * Configure serializer, following your groups entity configuration
     *
     * @param array $groups
     *
     * @return Serializer
     */
    public function configureSerializer(array $groups): Serializer
    {
        $encoder = new JsonEncoder();
        $defaultContext = [
            AbstractNormalizer::GROUPS => $groups,
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function (object $object): string {
                return $object->getId();
            },
        ];

        $extractor = new PropertyInfoExtractor([], [new PhpDocExtractor(), new ReflectionExtractor()]);
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader());
        $objectNormalizer = new ObjectNormalizer($classMetadataFactory, null, null, $extractor, null, null, $defaultContext);
        $normalizer = [new ArrayDenormalizer(), new DateTimeNormalizer(), $objectNormalizer];

        return new Serializer($normalizer, [$encoder]);
    }

    /**
     * @param array $data
     * @param array $groups
     *
     * @return array
     */
    public function serializeData(array $data, array $groups = ['default']): array
    {
        return json_decode($this->configureSerializer($groups)->serialize($data, 'json'));
    }
}