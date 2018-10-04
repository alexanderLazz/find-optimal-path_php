<?php

require_once('connect_graph.php');

?>

<html>
<body>
  <form action="find_short.php" method="post">
    <label for id="select-1">Начальная точка</label>
    <select id="select-1" name="node-1">
      <?php foreach ($graph as $key => $value) { ?>
        <option value="<?=$key ?>"><?=$key ?></option>
      <?php }
      ?>      
    </select>
    <label for id="select-2">Конечная точка</label>
    <select id="select-2" name="node-2">
      <?php foreach ($graph as $key => $value) { ?>
        <option value="<?=$key ?>"><?=$key ?></option>
      <?php }
      ?>      
    </select>    
    <br>
    <input type="submit" name="submit_button"
       value="Show"/>
  </form>
</body>
</html>
