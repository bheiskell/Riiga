<?php
  error_reporting(E_ALL);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Riiga - Temporarily down for maintenance</title>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
  <style type="text/css">
    body {
      background-color: #4a4138;
      font-family: 'lucida grande',verdana,helvetica,arial,sans-serif;
      font-size: 0.75em;
      line-height: 1.5em;
    }
    div {
      background-color: #efeac8;
      margin: 6em auto;
      padding: 1em;
      width: 600px;
      -moz-border-radius: 1em;
      border-radius: 1em;
    }
    h1 {
      color: #ee3322;
      font-family: 'Gill Sans','lucida grande', helvetica, arial, sans-serif;
      font-size: 2em;
      line-height: 1.5em;
      margin: 0;
      padding: 0;
      text-align: center;
    }
    h2 {
      color: #4b4239;
      font-family: 'Gill Sans','lucida grande', helvetica, arial, sans-serif;
      font-size: 1.5em;
      line-height: 1.5em;
      margin: 0.75em 0 0 0;
    }
    p {
      margin: 1em 0;
    }
    p:first-of-type {
      text-align: center;
      margin-top: 0;
    }
    strong {
      font-weight: bold;
    }
    textarea { 
      width: 100%;
      box-sizing: border-box;
      -moz-box-sizing: border-box;
      -webkit-box-sizing:border-box;
    }
  </style>
</head>
<body>
  <div>
    <h1>Riiga is getting an upgrade!</h1>
    <p>Sorry about that! We'll be back in a few minutes. (We hope.)</p>

    <?php $data = false; ?>
    <?php if (getSafePost('Character', 'description', $data)): ?>
      <h2>Description:</h2>
      <textarea rows="6" cols="30"><?php echo $data; ?></textarea>
    <?php endif; ?>

    <?php if (getSafePost('Character', 'history', $data)): ?>
      <h2>History:</h2>
      <textarea rows="6" cols="30"><?php echo $data; ?></textarea>
    <?php endif; ?>

    <?php if (getSafePost('Entry', 'content', $data)): ?>
      <h2>Entry:</h2>
      <textarea rows="6" cols="30"><?php echo $data; ?></textarea>
    <?php endif; ?>

    <?php if (false !== $data): ?>
      <p>
        <strong>Warning!!!</strong> The above text was not saved! Please save
        this to your computer. Once Riiga is back online, you can resubmit your
        request. We'll get Riiga back online as soon as we can!
      </p>
    <?php endif; ?>
  </div>
</body>
</html><?php
  /**
   * getSafePost
   *
   * If a post key is set, set value to the html encoded value. If it's not,
   * the value of value won't be altered. Return true if set.
   *
   * @param mixed $model  Key to look up
   * @param mixed $column Key to look up
   * @param mixed $value  Html encoded value
   * @access public
   * @return boolean True if set
   */
  function getSafePost($model, $column, &$value) {
    $value = (isset($_POST['data'][$model][$column]))
      ? htmlentities($_POST['data'][$model][$column])
      : $value;

    return (isset($_POST['data'][$model][$column]));
  }
