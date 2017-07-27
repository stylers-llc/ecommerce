<?php

namespace Stylers\Ecommerce\Manipulators;

use Stylers\Taxonomy\Exceptions\UserException;
use Stylers\Taxonomy\Models\Taxonomy;


abstract class Setter
{
    public static function validateRules(array $rules, array $data)
    {
        $validData = [];
        if (!empty($rules)) {
            if (!empty($rules['required'])) {
                self::required($rules['required'], $data);
            }

            if (!empty($rules['rules'])) {
                foreach ($data as $dataName => $dataValue) {
                    if (!empty($rules['rules'][$dataName])) {
                        foreach ($rules['rules'][$dataName] as $ruleName => $ruleValue) {
                            if (method_exists(__CLASS__, $ruleName)) {
                                if (!in_array($dataName, $rules['required']) && (empty(trim($dataValue)) || is_null($dataValue))) {
                                    continue;
                                }

                                if (!empty($ruleValue['return'])) {
                                    if (!empty($ruleValue['alias'])) {
                                        $validData[$ruleValue['alias']] = call_user_func('self::' . $ruleName,
                                            $ruleValue, $dataValue);
                                    } else {
                                        $validData[$dataName] = call_user_func('self::' . $ruleName, $ruleValue,
                                            $dataValue);
                                    }
                                } else {
                                    call_user_func('self::' . $ruleName, $dataValue);
                                    $validData[$dataName] = $dataValue;
                                }
                            } else {
                                $validData[$dataName] = $dataValue;
                            }
                        }
                    } else {
                        $validData[$dataName] = $dataValue;
                    }
                }
            } else {
                return $data;
            }
        }
        return $validData;
    }

    protected static function required($required, $data)
    {
        foreach ($required as $reqItem) {
            if (empty($data[$reqItem])) {
                throw new UserException($reqItem . " required");
            }
        }
    }


    protected static function taxonomy($rule, $data)
    {
        try {
            $parentId = $rule['parent'];
            $returnValue = $rule['return'];
        } catch (\Exception $e) {
            throw new UserException('Invalid parameters for validation');
        }

        $tx = Taxonomy::getTaxonomy($data, $parentId);
        return $tx->$returnValue;
    }

    protected static function is_boolean($data)
    {
        if (filter_var($data, FILTER_VALIDATE_BOOLEAN) === false) {
            throw new UserException('Invalid parameters not boolean');
        }
    }

    protected static function positive_number($data)
    {
        if ((filter_var($data, FILTER_VALIDATE_FLOAT) === false) OR ($data < 0)) {
            throw new UserException('Not positive number');
        }
    }
}