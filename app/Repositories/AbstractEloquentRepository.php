<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 31.12.2019
 * Time: 0:44
 */

namespace App\Repositories;

use App\Http\Requests\Admin\Filter\EntityFilterRequest;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractEloquentRepository implements Repository
{
    /**
     * @param $entity
     */
    public function save(Model $entity)
    {
        $entity->save();
    }

    /**
     * @param Model $entity
     * @throws \Exception
     */
    public function delete(Model $entity)
    {
        $entity->delete();
    }

    /**
     * Достаточно запутаный метод. Он получает на вход:
     * поле фильтрации, его значение, базовый запрос из таблицы, который описывает конкретая репа и массив полей которые надо брать из связанных таблиц
     * Если это поле внешний ключ - то мы фильтруем name из relation, иначе просто фильтруем по полю текущей таблицы
     *
     * @param EntityFilterRequest $entityFilterRequest
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getFilteredItems(EntityFilterRequest $entityFilterRequest)
    {
        if (array_key_exists($entityFilterRequest->getFilteredField(), $entityFilterRequest->getEntityRelationsFilters())) {
            $queryBuilder = $entityFilterRequest
                ->getBaseFilterQueryBuilder()
                ->whereHas(
                    array_get($entityFilterRequest->getEntityRelationsFilters(), $entityFilterRequest->getFilteredField()),
                    function($query) use($entityFilterRequest) {
                        $query->where("name", "like", "%" . $entityFilterRequest->getValue() . "%");
                    }
                );
        } else {
            $queryBuilder = $entityFilterRequest
                ->getBaseFilterQueryBuilder()
                ->where(
                    $entityFilterRequest->getFilteredField(),
                    "like",
                    "%" . $entityFilterRequest->getValue() . "%"
                );
        }

        return $queryBuilder->paginate($entityFilterRequest->getRecordsAmount());
    }
}
