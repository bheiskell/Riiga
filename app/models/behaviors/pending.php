<?php
/**
 * PendingBehavior
 *
 * Associate a pending model to the existing model for creating character
 * proposals. These proposals will have to accepted before moving them into the
 * primary table. This behavior attempts to cause the Pending model to behave
 * almost identical to the original model when queried or saved, but there are
 * many use cases where expected functionality could fail.
 *
 * Two outstanding issues. Required validation rules will fail if the field is
 * set to allowEmpty. I believe this is because fields are set to null on find,
 * but during the save null will register as not meeting the 'required'
 * validation rule. The second issue is relationships are not preserved. I
 * haven't resolved how to deal with this issue.
 *
 * @uses ModelBehavior
 * @author Ben Heiskell <ben.heiskell@gmail.com>
 */
class PendingBehavior extends ModelBehavior {

  function setup(&$Model, $settings) {
    $dbConfig     = $Model->useDbConfig;
    $pendingTable = 'pending_' . $Model->useTable;

    $Model->Pending = new Model(false, $pendingTable, $dbConfig);
    $Model->Pending->alias = $Model->alias;
    $Model->Pending->primaryKey = 'pending_id';
    $Model->Pending->validate = $Model->validate;
    $Model->Pending->Behaviors->attach('Containable');

    // Mirror current model associations for look-ups
    foreach ($Model->Pending->__associations as $type) {
      // hasAndBelongsToMany relationships are dangerous to pend currently. The
      // primary key will mismatch and corrupt associations
      if ('hasAndBelongsToMany' != $type) {
        $Model->Pending->{$type} = $Model->{$type};
      }
    }
    $Model->Pending->__createLinks();
  }

  /**
   * approvePending
   *
   * Approve a pending row by pending_id.
   *
   * @param mixed $Model Model to move approved data to
   * @param mixed $pending_id Id of row to move to the approved table
   * @access public
   * @return boolean Success of approval
   */
  function approvePending(&$Model, $pending_id) {
    $data = $Model->Pending->findByPendingId($pending_id);

    if (empty($data)) { return false; }

    $Model->set($data);

    if (!$Model->id) { $Model->create(); }

    return $Model->save($data) && $Model->Pending->delete($pending_id, false);
  }

  /**
   * savePending
   *
   * Save pending data to the pending table
   *
   * @param mixed $Model Model that will contain the approved data
   * @param mixed $data Data to be saved
   * @access public
   * @return boolean Success of save
   */
  function savePending(&$Model, $data) {
    $Model->set($data);

    if (!$Model->validates()) { return false; }

    $Model->Pending->set($data);

    if (!$Model->id) { $Model->Pending->create(); }

    $result = $Model->Pending->save($data);

    return $result;
  }
}
