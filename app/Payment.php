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
    "user_id", "category_id", "label", "amount"
  ];

  /**
   * The rules applied to user validation.
   *
   * @var array
   */
  public $rules = [
    "category_id" => "required",
    "amount" => "required",
    "label" => "required"
  ];

  /**
   * The messages returned in fail case for each rule validation.
   *
   * @var array
   */
  public $messages = [
    "required" => "The :attribute is required."
  ];

  /**
   * override function
   * 
   * @var int
   * @var int
   */
  public function find($user_id, $id) {
    return $this->where([
      ["id", "=", $id],
      ["user_id", "=", $user_id]
    ])->first();
  }
}
