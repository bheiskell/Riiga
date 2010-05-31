<div class="paging">
  <?php
    echo $paginator->prev(
      '<< '.__('previous', true),
      array(),
      null,
      array('class'=>'disabled')
    );
  ?> |
  <?php echo $paginator->numbers();?>
  <?php
    echo $paginator->next(
      __('next', true).' >>',
      array(),
      null,
      array('class' => 'disabled')
    );
  ?>
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
