<?php
/**
 * DeactivatableBehavior
 *
 * Behavior to consistently handle deactivating / reactivating behavior
 *
 * @uses ModelBehavior
 * @author Ben Heiskell <ben.heiskell@gmail.com> 
 */
class DeactivatableBehavior extends ModelBehavior {

  /**
   * beforeFind
   *
   * Automatically hide deactivated rows. This does not hide deactivated
   * rows in related binded tables.
   *
   * @param mixed $Model Model to opperate on
   * @param mixed $query Conditions of find: include key decativated => true to
   *                     override
   * @access public
   * @return array Conditions
   */
  function beforeFind(&$Model, $query) {
    if ($Model->hasField('is_deactivated')) {
      if (!isset($query['deactivated']) || !$query['deactivated']) {
        $query['conditions'][$Model->alias . '.is_deactivated'] = false;
      }
    }
    return $query;
  }

  /**
   * deactivate
   *
   * Deactivate a particular row.
   *
   * @param mixed $Model Model to opperate on
   * @param mixed $id
   * @access public
   * @return boolean True on successful deactivation
   */
  function deactivate(&$Model, $id) {
    if (!$id) { return false; }

    $Model->id = $id;
    $Model->set('is_deactivated', true);

    return $Model->save(null, false);
  }
}
