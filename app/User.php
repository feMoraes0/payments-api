<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
  use Authenticatable, Authorizable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    "name", "email", "password"
  ];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $hidden = [
    "password",
  ];

  /**
   * The rules applied to user validation.
   *
   * @var array
   */
  public $rules = [
    "name"      => "required",
    "email"     => "required|unique:users",
    "password"  => "required"
  ];

  /**
   * The messages returned in fail case for each rule validation.
   *
   * @var array
   */
  public $messages = [
    "required" => "The :attribute is required.",
    "unique" => "The :attribute has already been taken."
  ];
}
