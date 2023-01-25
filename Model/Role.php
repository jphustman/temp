<?php

class Role
{
    protected $table = 'roles';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
    ];
}