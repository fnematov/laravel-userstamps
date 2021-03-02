<?php

namespace Fnematov\LaravelUserstamps;

/**
 * Class Userstamps
 *
 * @package Fnematov\LaravelUserstamps
 */
class UserstampsTraitObserver
{
    /**
     * Model's creating event hook.
     *
     * @param \Fnematov\LaravelUserstamps\LaravelUserstampsTrait $model
     */
    public function creating($model)
    {
        if (! $model->created_by) {
            $model->created_by = $this->getAuthenticatedUserId();
        }

        if (! $model->updated_by) {
            $model->updated_by = $this->getAuthenticatedUserId();
        }

    }

    /**
     * Get authenticated user id depending on model's auth guard.
     *
     * @return int
     */
    protected function getAuthenticatedUserId()
    {
        return auth()->check() ? auth()->id() : 0;
    }

    /**
     * Model's updating event hook.
     *
     * @param \Fnematov\LaravelUserstamps\LaravelUserstampsTrait $model
     */
    public function updating($model)
    {
        if (! $model->isDirty('updated_by')) {
            $model->updated_by = $this->getAuthenticatedUserId();
        }
    }

    /**
     * Model's saving event hook.
     *
     * @param \Fnematov\LaravelUserstamps\LaravelUserstampsTrait $model
     */
    public function saving($model)
    {
        if (! $model->isDirty('updated_by')) {
            $model->updated_by = $this->getAuthenticatedUserId();
        }
    }


    /**
     * Model's deleting event hook.
     *
     * @param \Fnematov\LaravelUserstamps\LaravelUserstampsTrait $model
     */
    public function deleting($model)
    {
        if (! $model->isDirty('deleted_by')) {
            $model->deleted_by = $this->getAuthenticatedUserId();
            //explicit save if softdelete trait is used
            $model->save();
        }
    }

    /**
     * Model's restoring event hook.
     *
     * @param \Fnematov\LaravelUserstamps\LaravelUserstampsTrait $model
     */
    public function restoring($model)
    {
        if (! $model->isDirty('deleted_by')) {
            $model->deleted_by = null;
        }
    }
}