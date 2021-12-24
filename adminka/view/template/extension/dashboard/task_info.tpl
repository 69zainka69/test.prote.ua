<style>
.tile-body li{list-style:none;}
.tile-body li{line-height: 25px;}
.alert{overflow:hidden;}
.alert-dismissible .close{position: absolute; right: 30px; top: 10px; }
</style>
<div id="addtask" class="tile tile-primary">
  <div class="tile-heading">Импорт с Аксапты<span class="pull-right">

    <i class="fa fa-caret-up"></i>

    <i class="fa fa-caret-down"></i>

    </span></div>
  <div class="tile-body">
    <h3><i class="fa fa-credit-card"></i>&nbsp;&nbsp;&nbsp;&nbsp;Добавить в задачи</h3>
    <ul>
    <li><a href="<?php echo $url_add_task ?>&task=full">Полное обновление</a></li>
    <!-- <li><a href="<?php echo $url_add_task ?>&task=updatePriceList">Обновить Цены</a></li> -->
    </ul>
  </div>
  <div class="tile-footer"><a href=""></a></div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><i class="fa fa-shopping-cart"></i> Список обновлений</h3>
  </div>
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <td>Дата</td>
          <td>Комментарий</td>
          <td  class="text-right">Статус</td>
          <td>Время</td>
        </tr>
      </thead>
      <tbody>
        <?php if ($tasks){ ?>
        <?php foreach( $tasks as $task){ ?>
        <tr>
          <td><?php echo $task['date_start']; ?></td>
          <td><?php echo $task['comment']; ?></td>
          <td class="text-right"><?php echo $task['status']; ?></td>
          <td><?php echo $task['time']; ?></td>
        </tr>
        <?php } ?>
        <?php } else { ?>
        <tr>
          <td class="text-center" colspan="4"><?php echo $text_no_results ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<script>
$('#addtask li a').on('click',function(){
  href= $(this).attr('href');
  console.log(href);
  $.ajax({
        url: href,
        type: 'post',
        data: $('#addtask input').serialize(),
        dataType: 'json',
        beforeSend: function() {},
        complete: function() {},
        success: function(data) {
            console.log(data);
          if(data['success']){
            window.location.reload(false);
          }else if(data['error']){
            html ='<div class="alert alert-danger alert-dismissible">';
            $.each(data['error'], function(index, element) {
              html +='<div><i class="fa fa-exclamation-circle"></i> '+index+' : '+element+'</div>';
            });
            html +='<button type="button" class="close" data-dismiss="alert">×</button>';
            html +='</div>';
            $('#addtask').before(html);
          }

        },
        error: function(xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });

  return false;
});
</script>



