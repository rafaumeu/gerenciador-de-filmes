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
      $this->validations[$field][] = "O campo $field é obrigatório.";
    }
  }
  private function email($field, $value)
  {
    if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {
      $this->validations[$field][] = "O campo $field é invalido.";
    }
  }
  private function confirmed($field, $value, $confirmationValue)
  {
    if ($value != $confirmationValue) {
      $this->validations[$field][] = "O campo $field não corresponde.";
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
      $this->validations[$field][] = "O campo $field deve ter pelo menos $min caracteres.";
    }
  }
  private function max($max, $field, $value)
  {
    if (strlen($value) > $max) {
      $this->validations[$field][] = "O campo $field deve ter no máximo $max caracteres.";
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
      $this->validations[$field][] = "O campo $field já está em uso.";
    }
  }

  private function strong($field, $value)
  {
    if (!preg_match("/[A-Z]/", $value)) {
      $this->validations[$field][] = "O campo $field deve conter pelo menos uma letra maiúscula.";
    }
    if (!preg_match("/[^a-zA-Z0-9]/", $value)) {
      $this->validations[$field][] = "O campo $field deve conter pelo menos um caractere especial.";
    }
  }
}
