<?php

namespace Test\Unit\Adapter;

use Lencse\Adapter\DependencyInjection\AurynDic;
use Lencse\Application\Controller\GetAllTypesController;
use Lencse\Application\Controller\GetTypeController;
use Lencse\WorkCalendar\Calendar\DayType\DayType;
use Lencse\WorkCalendar\Calendar\Repository\DayRepository;
use Lencse\WorkCalendar\Calendar\Repository\DayTypeRepository;
use Lencse\WorkCalendar\Calendar\Repository\SpecialDayRepositoryFactory;
use Lencse\WorkCalendar\Hu\Repository\HuDayTypeRepository;
use Lencse\WorkCalendar\Hu\Repository\HuSpecialDayRepositoryFactory;
use PHPUnit\Framework\TestCase;

class AurynDicTest extends TestCase
{

    public function testMakeConcrete()
    {
        $dic = new AurynDic();
        $obj = $dic->make(HuDayTypeRepository::class);

        $this->assertTrue($obj instanceof HuDayTypeRepository);
    }

    public function testMakeAbstract()
    {
        $dic = new AurynDic();
        $dic->bind(DayTypeRepository::class, HuDayTypeRepository::class);
        $obj = $dic->make(DayTypeRepository::class);

        $this->assertTrue($obj instanceof HuDayTypeRepository);
    }

    public function testCall()
    {
        $dic = new AurynDic();
        $dic->bind(DayTypeRepository::class, HuDayTypeRepository::class);
        $result = $dic->call(GetAllTypesController::class);
        $this->assertTrue($result[0] instanceof DayType);
    }

    public function testCallWithParameters()
    {
        $dic = new AurynDic();
        $dic->bind(DayTypeRepository::class, HuDayTypeRepository::class);
        $result = $dic->call(GetTypeController::class, ['key' => HuDayTypeRepository::SWITCHED_REST_DAY]);
        $this->assertTrue($result instanceof DayType);
    }

    public function testFactory()
    {
        $dic = new AurynDic();
        $dic->bind(DayTypeRepository::class, HuDayTypeRepository::class);
        $dic->factory(DayRepository::class, HuSpecialDayRepositoryFactory::class);
        $result = $dic->make(DayRepository::class);
        $this->assertTrue($result instanceof DayRepository);
    }
}
