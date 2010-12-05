<?php
App::import('Vendor', 'Find.find_app_model');

class AppModel extends FindAppModel {
  /**
   * actsAs
   *
   * Behaviors that must always be applied:
   *   - To minimize the number of queries, always activate containable
   *   - To verify the integrity of foreign keys, attach the belongs to behavior
   *   - Attempt to automatically hide deactivated rows
   * @var string
   * @access public
   */
  var $actsAs = array('Containable', 'VerifyBelongsTo', 'Deactivatable');

  /**
   * recursive
   *
   * By default, restrict find calls to the bare minimum.
   *
   * @var mixed
   * @access public
   */
  var $recursive = -1;
}
