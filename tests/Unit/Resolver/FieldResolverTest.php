<?php

declare(strict_types=1);

namespace Wata\DwhQueryBundle\Tests\Unit\Resolver;

use GraphQL\Type\Definition\ResolveInfo;
use PHPUnit\Framework\TestCase;
use Wata\DwhQueryBundle\Resolver\FieldResolver;
use Wata\DwhQueryBundle\Tests\Resources\Entity\SampleEntity;

class FieldResolverTest extends TestCase
{
    public function testDefaultFieldResolverInArray(): void
    {
        // GIVEN
        $info = $this->getMockBuilder(ResolveInfo::class)
            ->disableOriginalConstructor()
            ->getMock();
        $info->fieldName = 'fieldOne';
        $entity = [
            'fieldOne' => 'value1'
        ];

        // WHEN
        $fieldResolver = new FieldResolver();
        $result = $fieldResolver->__invoke($entity, [], [], $info);

        // THEN
        $this->assertEquals('value1', $result);
    }

    public function testDefaultFieldResolverWithPublicField(): void
    {
        // GIVEN
        $info = $this->getMockBuilder(ResolveInfo::class)
            ->disableOriginalConstructor()
            ->getMock();
        $info->fieldName = 'fieldOne';
        $entity = new SampleEntity('value1', 'value2', true, false);

        // WHEN
        $fieldResolver = new FieldResolver();
        $result = $fieldResolver->__invoke($entity, [], [], $info);

        // THEN
        $this->assertEquals('value1', $result);
    }

    public function testDefaultFieldResolverWithGet(): void
    {
        // GIVEN
        $info = $this->getMockBuilder(ResolveInfo::class)
            ->disableOriginalConstructor()
            ->getMock();
        $info->fieldName = 'fieldTwo';
        $entity = new SampleEntity('value1', 'value2', true, false);

        // WHEN
        $fieldResolver = new FieldResolver();
        $result = $fieldResolver->__invoke($entity, [], [], $info);

        // THEN
        $this->assertEquals('value2', $result);
    }

    public function testDefaultFieldResolverWithIs(): void
    {
        // GIVEN
        $info = $this->getMockBuilder(ResolveInfo::class)
            ->disableOriginalConstructor()
            ->getMock();
        $info->fieldName = 'fieldThree';
        $entity = new SampleEntity('value1', 'value2', true, false);

        // WHEN
        $fieldResolver = new FieldResolver();
        $result = $fieldResolver->__invoke($entity, [], [], $info);

        // THEN
        $this->assertTrue($result);
    }


    public function testDefaultFieldResolverWithHas(): void
    {
        // GIVEN
        $info = $this->getMockBuilder(ResolveInfo::class)
            ->disableOriginalConstructor()
            ->getMock();
        $info->fieldName = 'fieldFour';
        $entity = new SampleEntity('value1', 'value2', true, false);

        // WHEN
        $fieldResolver = new FieldResolver();
        $result = $fieldResolver->__invoke($entity, [], [], $info);

        // THEN
        $this->assertFalse($result);
    }
}
