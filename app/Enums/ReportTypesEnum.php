<?php

namespace App\Enums;

class ReportTypesEnum extends AbstractEnum
{
    public const ALL_ORDERS = 1;
    public const ORDERS_STATS = 2;
    public const TOP_PRODUCTS = 3;
    public const PRODUCTS_STATS = 4;
    public const TOP_CLIENTS = 5;
    public const CLIENTS_STATS = 6;

    /**
     * @var array
     */
    protected $enums = [
        self::ALL_ORDERS     => 'Все заказы',
        self::ORDERS_STATS   => 'Статистика заказов',
        self::TOP_PRODUCTS   => 'Топ товаров',
        self::PRODUCTS_STATS => 'Статистика товаров',
        self::TOP_CLIENTS    => 'Топ клиентов',
        self::CLIENTS_STATS  => 'Статистика клиентов',
    ];

    /**
     * @param $id
     * @return ReportTypesEnum
     */
    public static function CREATE($id)
    {
        return new self($id);
    }

    /**
     * @return ReportTypesEnum
     */
    public static function ALL_ORDERS()
    {
        return new self(self::ALL_ORDERS);
    }

    /**
     * @return ReportTypesEnum
     */
    public static function ORDERS_STATS()
    {
        return new self(self::ORDERS_STATS);
    }

    /**
     * @return ReportTypesEnum
     */
    public static function TOP_PRODUCTS()
    {
        return new self(self::TOP_PRODUCTS);
    }

    /**
     * @return ReportTypesEnum
     */
    public static function PRODUCTS_STATS()
    {
        return new self(self::PRODUCTS_STATS);
    }

    /**
     * @return ReportTypesEnum
     */
    public static function TOP_CLIENTS()
    {
        return new self(self::TOP_CLIENTS);
    }

    /**
     * @return ReportTypesEnum
     */
    public static function CLIENTS_STATS()
    {
        return new self(self::CLIENTS_STATS);
    }
}