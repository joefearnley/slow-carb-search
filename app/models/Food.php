<?php

class Food extends Eloquent {

  /**
    * The database table used by the model.
    *
    * @var string
    */
  protected $table = 'food';

  public static $unguarded = true;

  public function getId()
  {
    return $this->id;
  }

  public function setName($name)
  {
    $this->name = $name;
  }

  public function getName()
  {
    return $this->name;
  }

  public function setDescription($description)
  {
    $this->description = $description;
  }

  public function getDescription()
  {
    return $this->description;
  }

  public function setAllowed($allowed)
  {
    $this->allowed = $allowed;
  }

  public function getAllowed()
  {
    return $this->allowed;
  }

  public function setAllowedInModeration($allowedInModeration)
  {
    $this->allowed_moderation = $allowedInModeration;
  }

  public function getAllowedInModeration()
  {
    return $this->allowed_moderation;
  }

  public function getFoodGroupId()
  {
    return $this->food_group_id;
  }

  public function getFoodGroup()
  {
    return FoodGroup::find($this->food_group_id)->getName();
  }
  
  public function getAllowedAsString()
  {
    return ($this->allowed === 1) ? "yes" : "no";
  }

  public function getAllowedInModerationAsString()
  {
    return ($this->allowed_moderation == 1) ? "yes" : "no";
  }

  public function getAllowedChecked()
  {
    return ($this->allowed == 1) ? "checked" : "";
  }

  public function getAllowedInModerationChecked()
  {
    return ($this->allowed_moderation == 1) ? "checked" : "";
  }
  
  public function getItems()
  {
    return $this->items;
  }
}