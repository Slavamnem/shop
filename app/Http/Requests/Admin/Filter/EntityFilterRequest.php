<?php

namespace App\Http\Requests\Admin\Filter;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;

class EntityFilterRequest extends FormRequest
{
    const DEFAULT_FILTERED_RECORDS_AMOUNT = 10;

    /**
     * @var array
     */
    private $entityRelationsFilters;
    /**
     * @var Builder
     */
    private $baseFilterQueryBuilder;
    /**
     * @var int
     */
    private $recordsAmount;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [];
    }

    /**
     * @return string|null
     */
    public function getFilteredField()
    {
        return $this->input('field');
    }

    /**
     * @return string|null
     */
    public function getValue()
    {
        return $this->input('value');
    }

    /**
     * @return array
     */
    public function getEntityRelationsFilters(): array
    {
        return $this->entityRelationsFilters;
    }

    /**
     * @param array $entityRelationsFilters
     * @return EntityFilterRequest
     */
    public function setEntityRelationsFilters(array $entityRelationsFilters): EntityFilterRequest
    {
        $this->entityRelationsFilters = $entityRelationsFilters;
        return $this;
    }

    /**
     * @return Builder
     */
    public function getBaseFilterQueryBuilder(): Builder
    {
        return $this->baseFilterQueryBuilder;
    }

    /**
     * @param Builder $baseFilterQueryBuilder
     * @return EntityFilterRequest
     */
    public function setBaseFilterQueryBuilder(Builder $baseFilterQueryBuilder): EntityFilterRequest
    {
        $this->baseFilterQueryBuilder = $baseFilterQueryBuilder;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRecordsAmount()
    {
        return $this->recordsAmount ?? self::DEFAULT_FILTERED_RECORDS_AMOUNT;
    }

    /**
     * @param mixed $recordsAmount
     * @return EntityFilterRequest
     */
    public function setRecordsAmount($recordsAmount)
    {
        $this->recordsAmount = $recordsAmount;
        return $this;
    }
}
