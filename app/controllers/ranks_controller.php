<?php
class RanksController extends AppController {
  var $name     = 'Ranks';
  var $scaffold = 'admin';

  public function index() {
    $ranks = Set::combine(
      $this->Rank->find('all'),
      '{n}.Rank.id',
      '{n}'
    );

    $this->loadModel('User');

    $user_id = $this->Auth->user('id');
    $rank_id = $this->User->getRank($user_id, $entries_count);

    $next_rank_id = (isset($ranks[$rank_id + 1])) ? $rank_id + 1 : false;

    $this->set(compact('ranks', 'entries_count', 'rank_id', 'next_rank_id'));
  }
}
