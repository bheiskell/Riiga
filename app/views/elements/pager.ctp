<?php $paginator->options(array('url' => $this->passedArgs)); ?>
<div class="paging">
  <?php echo $paginator->first('<<'); ?>
  <?php
    echo $paginator->prev(
      '<',
      array(),
      null,
      array('class'=>'disabled')
    );
  ?> |
  <?php echo $paginator->numbers();?>
  <?php
    echo $paginator->next(
      '>',
      array(),
      null,
      array('class' => 'disabled')
    );
  ?>
  <?php echo $paginator->last('>>'); ?>
  <?php
    echo $paginator->counter(
      array(
        'format' => __(
          'Page %page% of %pages%, showing %current% out of %count%',
          true
        )
      )
    );
  ?> 
</div>
