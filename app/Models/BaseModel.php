<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    use SoftDeletes;
    
    /**
     * delete by ids
     * @param  array $ids
     * @return boolean
     */
    public function deleteByIds($ids)
    {
        if (empty($ids)) {
            return false;
        }
        return $this->whereIn('id', $ids)
                    ->delete();
    }

    /**
     * Force delete by ids
     * @param  array $ids
     * @return boolean
     */
    public function forceDeleteByIds($ids)
    {
        if (empty($ids)) {
            return false;
        }
        return $this->whereIn('id', $ids)
                    ->forceDelete();
    }

    /**
     * Perform the actual delete query on this model instance.
     * overide \Illuminate\Database\Eloquent\SoftDeletes::runSoftDelete()
     * @return void
     */
    protected function runSoftDelete()
    {
        $query = $this->newQueryWithoutScopes()->where($this->getKeyName(), $this->getKey());
        $time = $this->freshTimestamp();
        $columns = [
            $this->getDeletedAtColumn() => $this->fromDateTime($time),
            $this->getDeletedByColumn() => $this->getCurrentUserId()
        ];
        $this->{$this->getDeletedAtColumn()} = $time;
        $this->{$this->getDeletedByColumn()} = $this->getCurrentUserId();
        if ($this->timestamps && ! is_null($this->getUpdatedAtColumn())) {
            $this->{$this->getUpdatedAtColumn()} = $time;
            $columns[$this->getUpdatedAtColumn()] = $this->fromDateTime($time);
        }
        $query->update($columns);
    }
    
    /**
     * Get the name of the "deleted by" column.
     *
     * @return string
     */
    private function getDeletedByColumn()
    {
        return defined('static::DELETED_BY') ? static::DELETED_BY : 'deleted_by';
    }
    
    /**
    * Get current user id
    * @return int
    */
    private function getCurrentUserId()
    {
        $user_id = session('rentersnet_oauth.user_id');
        return $user_id;
    }
}
