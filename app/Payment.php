<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    "label", "amout"
  ];

  /**
   * The rules applied to user validation.
   *
   * @var array
   */
  public $rules = [
    "label"   => "required",
    "amount"  => "required"
  ];

  /**
   * The messages returned in fail case for each rule validation.
   *
   * @var array
   */
  public $messages = [
    "required" => "The :attribute is required."
  ];
}
