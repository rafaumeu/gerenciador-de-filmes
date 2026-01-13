<?php
class Validation
{
  public $validations = [];

  public static function validate($rules, $data)
  {
    $validation = new self;
    foreach ($rules as $field => $fieldRules) {
      $fieldValue = $data[$field];
      foreach ($fieldRules as $rule)
        if ($rule == 'confirmed') {
          $validation->$rule($field, $fieldValue, $data["{$field}_confirmation"]);
        } elseif (str_contains($rule, ':')) {
          [$ruleName, $parameter] = explode(':', $rule);
          $validation->$ruleName($parameter, $field, $fieldValue);
        } else {
          $validation->$rule($field, $fieldValue);
        }
    }
    return $validation;
  }
  private function required($field, $value)
  {
    if (empty($value)) {
      $this->validations[] = "The $field is required.";
    }
  }
  private function email($field, $value)
  {
    if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {
      $this->validations[] = "The $field is invalid.";
    }
  }
  private function confirmed($field, $value, $confirmationValue)
  {
    if ($value != $confirmationValue) {
      $this->validations[] = "The confirmation $field does not match.";
    }
  }

  public function fails($customName = null)
  {
    $key = 'validations';
    if ($customName) {
      $key .= '_' . $customName;
    }
    flash()->push($key, $this->validations);
    return sizeof($this->validations) > 0;
  }
  private function min($min, $field, $value)
  {
    if (strlen($value) < $min) {
      $this->validations[] = "The $field must have at least $min characters.";
    }
  }
  private function max($max, $field, $value)
  {
    if (strlen($value) > $max) {
      $this->validations[] = "The $field must have at most $max characters.";
    }
  }
  private function unique($table, $field, $value)
  {
    if (strlen($value) == 0) {
      return;
    }
    $db =  new Database(config('database'));
    $result = $db->query(
      query: "select * from $table where $field = :value",
      params: ['value' => $value]
    )->fetch();
    if ($result) {
      $this->validations[] = "The $field is already in use.";
    }
  }

  private function strong($field, $value)
  {
    if (!preg_match("/[A-Z]/", $value)) {
      $this->validations[] = "The $field must contain at least one uppercase letter.";
    }
    if (!preg_match("/[^a-zA-Z0-9]/", $value)) {
      $this->validations[] = "The $field must contain at least one special character.";
    }
  }
}
