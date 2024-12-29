<?php

namespace app\core;

use Exception;

class Validator
{
    protected array $data;
    protected array $rules;
    protected array $messages;
    protected array $customAttributes = [];
    protected array $errors = [];
    protected array $validatedData = [];
    protected array $defaultMessages;

    public function __construct(array $data, array $rules, array $messages = [], array $customAttributes = [])
    {
        $this->data = $data;
        $this->rules = $rules;
        $this->messages = $messages;
        $this->customAttributes = $customAttributes;

        $this->defaultMessages = Config::get('validator_messages')[Config::get('app.locale')] ?? [];
    }

    /**
     * Validate the given data against the rules.
     */
    public function validate(): Validator
    {
        foreach ($this->rules as $field => $rules) {
            $rules = explode('|', $rules);

            foreach ($rules as $rule) {
                [$ruleName, $parameter] = $this->parseRule($rule);

                $value = $this->data[$field] ?? null;

                $methodName = "validate" . ucfirst($ruleName);

                if (!method_exists($this, $methodName)) {
                    throw new Exception("Validation rule '{$ruleName}' is not supported.");
                }

                try {
                    $this->$methodName($field, $value, $parameter);
                } catch (Exception $e) {
                    $this->addError($field, $ruleName, $parameter);
                }
            }
        }

        if ($this->fails()) {
            // return $this->errors;
            return $this; 
        }

        $this->validatedData = array_intersect_key($this->data, $this->rules);

        return $this; 
    }

    /**
     * Parse the rule and its parameter.
     */
    protected function parseRule(string $rule): array
    {
        if (str_contains($rule, ':')) {
            return explode(':', $rule, 2);
        }

        return [$rule, null];
    }

    /**
     * Add error message for a field.
     */
    protected function addError(string $field, string $ruleName, $parameter = null): void
    {
        $attribute = $this->customAttributes[$field] ?? $field;
        $messageTemplate = $this->messages[$ruleName] ?? $this->getDefaultMessage($ruleName);

        $this->errors[$field][] = str_replace(
            [':attribute', ':value', ':parameter'],
            [$attribute, $this->data[$field] ?? '', $parameter],
            $messageTemplate
        );
    }

    /**
     * Get the default validation message for a rule.
     */
    protected function getDefaultMessage(string $ruleName): string
    {
        if (isset($this->defaultMessages[$ruleName])) {
            return $this->defaultMessages[$ruleName];
        }

        return "The :attribute field has an invalid value.";
    }

    /**
     * Dynamically set default validation messages.
     */
    public function setDefaultMessages(array $messages): void
    {
        $this->defaultMessages = array_merge($this->defaultMessages, $messages);
    }

    /**
     * Check if validation failed.
     */
    public function fails(): bool
    {
        return !empty($this->errors);
    }

    /**
     * Retrieve all errors.
     */
    public function errors(): array
    {
        return $this->errors;
    }

    /**
     * Retrieve the first error message for a specific field.
     */
    public function first(string $field): ?string
    {
        return $this->errors[$field][0] ?? null;
    }

    /**
     * Retrieve validated data.
     */
    public function validated(): array
    {
        return $this->validatedData;
    }

    // Validation rules

    protected function validateRequired(string $field, $value): void
    {
        if (empty($value)) {
            throw new Exception();
        }
    }

    protected function validateMax(string $field, $value, $parameter): void
    {
        if (strlen($value) > (int) $parameter) {
            throw new Exception();
        }
    }

    protected function validateMin(string $field, $value, $parameter): void
    {
        if (strlen($value) < (int) $parameter) {
            throw new Exception();
        }
    }

    protected function validateUnique(string $field, $value, $parameter): void
    {
        [$table, $column] = explode(',', $parameter);
        $exists = Database::query("SELECT COUNT(*) as count FROM {$table} WHERE {$column} = ?", [$value])->fetchColumn();

        if ($exists > 0) {
            throw new Exception();
        }
    }

    protected function validateEmail(string $field, $value): void
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new Exception();
        }
    }

    protected function validateEqual(string $field, $value, $parameter): void
    {
        if ($value !== $parameter) {
            throw new Exception();
        }
    }

    protected function validateContains(string $field, $value, $parameter): void
    {
        if (strpos($value, $parameter) === false) {
            throw new Exception();
        }
    }

    protected function validateRegex(string $field, $value, $parameter): void
    {
        if (!preg_match($parameter, $value)) {
            throw new Exception();
        }
    }

    protected function validateMatch(string $field, $value, $parameter): void
    {
        if (!preg_match($parameter, $value)) {
            throw new Exception();
        }
    }
}
