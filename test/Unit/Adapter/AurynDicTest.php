<?php

namespace Test\Unit\Adapter;

use DateTime;
use DateTimeInterface;
use Lencse\Adapter\DependencyInjection\AurynDic;
use Lencse\Application\Controller\GetAllTypesController;
use Lencse\Application\Controller\GetTypeController;
use Lencse\Date\DateHelper;
use Lencse\WorkCalendar\Calendar\DayType\Entity\DayType;
use Lencse\WorkCalendar\Calendar\Day\Repository\DayRepository;
use Lencse\WorkCalendar\Calendar\DayType\Repository\DayTypeRepository;
use Lencse\WorkCalendar\Calendar\Day\Repository\SpecialDayRepositoryFactory;
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

    public function testShareInstance()
    {
        $dic = new AurynDic();
        $dic->shareInstance(DateTimeInterface::class, DateHelper::dateTime('2018-03-15'));
        /** @var DateTime $result */
        $result = $dic->make(DateTimeInterface::class);
        $this->assertEquals('2018-03-15', $result->format('Y-m-d'));
    }

    public function testShare()
    {
        $dic = new AurynDic();
        $dic->share(DateTime::class);
        /** @var DateTime $date */
        $date = $dic->make(DateTime::class);
        $date->setDate(2018, 1, 1);
        /** @var DateTime $result */
        $result = $dic->make(DateTime::class);
        $this->assertEquals('2018-01-01', $result->format('Y-m-d'));
    }
}
