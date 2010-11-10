<?php
/**
 * VerifyBelongsToBehavior
 *
 * This behavior checks that a submitted foreign key for a belongsTo
 * relationship actually exists in the related tables. Assuming the database
 * foreign keys are configured correctly, a database error should be triggered
 * on the insert/update, but I'd prefer to catch this error at the validation
 * stage.
 *
 * @uses ModelBehavior
 * @author Ben Heiskell <ben.heiskell@gmail.com> 
 */
class VerifyBelongsToBehavior extends ModelBehavior {
  function beforeValidate(&$Model) {
    $valid = true;

    foreach ($Model->belongsTo as $model => $settings) {
      $key = $settings['foreignKey'];
      $id  = $Model->data[$Model->alias][$key];

      $Model->{$model}->id = $id;

      if (!empty($id) && !$Model->{$model}->exists()) {
        $valid = false;
        $Model->invalidate($key, sprintf(__("ID %s doesn't exist", true), $id));
      }
    }
    return $valid;
  }
}
