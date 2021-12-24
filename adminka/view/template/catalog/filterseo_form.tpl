<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button id="savecopy" data-toggle="tooltip" title="Сохранить копию" class="btn"><i class="fa fa-copy"></i></button>
        <button id="savebtn" type="submit" form="form-category" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-category" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
            <li><a href="#tab-data" data-toggle="tab"><?php echo $tab_data; ?></a></li>
            <li><a href="#tab-question" data-toggle="tab">Вопрос/Ответ</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
              <ul class="nav nav-tabs" id="language">
                <?php foreach ($languages as $language) { ?>
                <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                <?php } ?>
              </ul>
              <div class="tab-content">
                <?php foreach ($languages as $language) { ?>
                <div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-name<?php echo $language['language_id']; ?>"><?php echo $entry_name; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="filterseo_description[<?php echo $language['language_id']; ?>][name]" value="<?php echo isset($filterseo_description[$language['language_id']]) ? $filterseo_description[$language['language_id']]['name'] : ''; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name<?php echo $language['language_id']; ?>" class="form-control" />
                      <?php if (isset($error_name[$language['language_id']])) { ?>
                      <div class="text-danger"><?php echo $error_name[$language['language_id']]; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-description<?php echo $language['language_id']; ?>"><?php echo $entry_description; ?></label>
                    <div class="col-sm-10">
                      <textarea name="filterseo_description[<?php echo $language['language_id']; ?>][description]" placeholder="<?php echo $entry_description; ?>" id="input-description<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($filterseo_description[$language['language_id']]) ? $filterseo_description[$language['language_id']]['description'] : ''; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-meta-title<?php echo $language['language_id']; ?>"><?php echo $entry_meta_title; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="filterseo_description[<?php echo $language['language_id']; ?>][meta_title]" value="<?php echo isset($filterseo_description[$language['language_id']]) ? $filterseo_description[$language['language_id']]['meta_title'] : ''; ?>" placeholder="<?php echo $entry_meta_title; ?>" id="input-meta-title<?php echo $language['language_id']; ?>" class="form-control" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-meta-h1<?php echo $language['language_id']; ?>"><?php echo $entry_meta_h1; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="filterseo_description[<?php echo $language['language_id']; ?>][meta_h1]" value="<?php echo isset($filterseo_description[$language['language_id']]) ? $filterseo_description[$language['language_id']]['meta_h1'] : ''; ?>" placeholder="<?php echo $entry_meta_h1; ?>" id="input-meta-h1<?php echo $language['language_id']; ?>" class="form-control" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-meta-description<?php echo $language['language_id']; ?>"><?php echo $entry_meta_description; ?></label>
                    <div class="col-sm-10">
                      <textarea name="filterseo_description[<?php echo $language['language_id']; ?>][meta_description]" rows="5" placeholder="<?php echo $entry_meta_description; ?>" id="input-meta-description<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($filterseo_description[$language['language_id']]) ? $filterseo_description[$language['language_id']]['meta_description'] : ''; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-meta-keyword<?php echo $language['language_id']; ?>"><?php echo $entry_meta_keyword; ?></label>
                    <div class="col-sm-10">
                      <textarea name="filterseo_description[<?php echo $language['language_id']; ?>][meta_keyword]" rows="5" placeholder="<?php echo $entry_meta_keyword; ?>" id="input-meta-keyword<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($filterseo_description[$language['language_id']]) ? $filterseo_description[$language['language_id']]['meta_keyword'] : ''; ?></textarea>
                    </div>
                  </div>
                </div>
                <?php } ?>
              </div>
            </div>
            <div class="tab-pane" id="tab-data">

              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-attribute-group">Категория</label>
                <div class="col-sm-10">
                  <select name="category_id" id="input-category" class="form-control">
                    <?php foreach ($categories as $category) { ?>
                    <?php if ($category['category_id'] == $category_id) { ?>
                    <option value="<?php echo $category['category_id']; ?>" selected="selected"><?php echo $category['name'].' ['.$category['category_id'].']'; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name'].' ['.$category['category_id'].']'; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>                  
                </div>
            </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-filter"><span data-toggle="tooltip" title="<?php echo $help_filter; ?>">Введите фильтр:</span></label>
                <div class="col-sm-10">
                  <?php if ($error_filter) { ?>
                    <div class="text-danger"><?php echo $error_filter; ?></div>
                  <?php } ?>
                  <input type="text" name="filter" value="" placeholder="Введите фильтр:" id="input-filter" class="form-control" />
                  <div id="filterseo_filters" class="well well-sm" style="height: 150px; overflow: auto;">
                    <?php foreach ($filterseo_filters as $filterseo_filter) { ?>
                    <div id="filter-filter<?php echo $filterseo_filter['filter_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $filterseo_filter['name']; ?>
                      <input type="hidden" name="filterseo_filters[]" value="<?php echo $filterseo_filter['filter_id']; ?>" data-name="<?php echo $filterseo_filter['filter_id']; ?>" />
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            
            <div class="form-group required hidden">
                <label class="col-sm-2 control-label" for="input-attribute-group">Группа фильтра</label>
                <div class="col-sm-10">
                  <select name="filter_group_id" id="input-filter_group" class="form-control">
                    <?php foreach ($filter_groups as $filter_group) { ?>
                    <?php if ($filter_group['filter_group_id'] == $filter_group_id) { ?>
                    <option value="<?php echo $filter_group['filter_group_id']; ?>" selected="selected"><?php echo $filter_group['name'].' ['.$filter_group['filter_group_id'].']'; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $filter_group['filter_group_id']; ?>"><?php echo $filter_group['name'].' ['.$filter_group['filter_group_id'].']'; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>                  
                </div>
            </div>
            
            <div class="form-group required hidden">
                <label class="col-sm-2 control-label" for="input-attribute-group">Значение фильтра</label>
                <div class="col-sm-10">
                  <!-- <select name="filter_id" id="input-filter" class="form-control"></select>       -->
                  <?php if ($error_filter) { ?>
                    <div class="text-danger"><?php echo $error_filter; ?></div>
                  <?php } ?>
                  <div class="well well-sm" style="min-height: 150px;max-height: 500px;overflow: auto;">
                    <table id="filter_id" class="table table-striped">
                      <?php echo $filters; ?>
                    </table>
                  </div>
                </div>
            </div>


              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-keyword"><span data-toggle="tooltip" title="<?php echo $help_keyword; ?>"><?php echo $entry_keyword; ?></span></label>
                <div class="col-sm-10">
                  <input type="text" name="keyword" value="<?php echo $keyword; ?>" placeholder="<?php echo $entry_keyword; ?>" id="input-keyword" class="form-control" />
                  <?php if ($error_keyword) { ?>
                  <div class="text-danger"><?php echo $error_keyword; ?></div>
                  <?php } ?>                
                </div>
              </div>
              

              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                <div class="col-sm-10">
                  <select name="status" id="input-status" class="form-control">
                    <?php if ($status) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab-question">
              <div class="table-responsive">
                <table id="question-value" class="table table-striped table-bordered table-hover">
                  <thead>
                  <tr>
                    <td class="text-left">Вопрос</td>
                    <td class="text-left">Ответ</td>
                    <td class="text-left"></td>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $question_row = 0; ?>
                  <?php foreach ($questions as $question) { ?>
                  <tr id="question-row<?php echo $question_row; ?>">
                    <td class="text-left">
                      <select readonly name="question[<?php echo $question_row; ?>][question_id]" class="form-control">
                        <option value=""></option>
                        <?php foreach ($all_question as $q) { ?>
                        <?php if ($question['question_id'] == $q['question_id']) { ?>
                        <option value="<?php echo $q['question_id']; ?>" selected="selected"><?php echo $q['name']; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $q['question_id']; ?>"><?php echo $q['name']; ?></option>
                        <?php } ?>
                        <?php } ?>
                      </select>
                      <?php if(isset($question['question_description'])){ ?>
                      <?php foreach ($languages as $language) { ?>
                      <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                        <input type="text" name="question[<?php echo $question_row; ?>][question_description][<?php echo $language['language_id']; ?>][name]" value="<?php echo isset($question['question_description'][$language['language_id']]['name']) ? $question['question_description'][$language['language_id']]['name'] : ''; ?>" placeholder="Вопрос" class="form-control" />
                      </div>
                      <?php } ?>
                      <?php } ?>
                    </td>
                    <td class="text-left">
                      <?php if(isset($question['question_description'])){ ?>
                      <?php foreach ($languages as $language) { ?>
                      <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                        <textarea name="question[<?php echo $question_row; ?>][question_description][<?php echo $language['language_id']; ?>][text]" id="input-question[<?php echo $question_row; ?>]<?php echo $language['language_id']; ?>" placeholder="" class="form-control"><?php echo isset($question['question_description'][$language['language_id']]['text']) ? $question['question_description'][$language['language_id']]['text'] : ''; ?></textarea>
                      </div>
                      <?php } ?>
                      <?php } ?>

                    </td>
                    <td class="text-left"><button type="button" onclick="$('#question-row<?php echo $question_row; ?>').remove();" data-toggle="tooltip" title="Удалить" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                  </tr>
                  <?php $question_row++; ?>
                  <?php } ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <td colspan="2"></td>
                    <td class="text-left"><button type="button" onclick="addQuestion();" data-toggle="tooltip" title="Добавить вопрос" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                  </tr>
                  </tfoot>

                </table>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
<?php if ($ckeditor) { ?>
ckeditorInit('input-description<?php echo $language['language_id']; ?>', '<?php echo $token; ?>');
<?php } else { ?>
$('#input-description<?php echo $language['language_id']; ?>').summernote({
	height: 300,
    lang:'<?php echo $lang; ?>'
});
<?php } ?>
<?php } ?>
//--></script> 
<style>
.dropdown-menu{
    max-height: 300px;
    overflow: auto;
}
</style>
  <script type="text/javascript"><!--

$('select[name=\'filter_group_id\']').on('change', function(){ 
   $('#filter_id').load('index.php?route=catalog/filterseo/getFilters&token=<?php echo $token; ?>&filter_group_id=' +  encodeURIComponent(this.value));

/*
  $.ajax({
      url: 'index.php?route=catalog/filterseo/getFilters&token=<?php echo $token; ?>&filter_group_id=' +  encodeURIComponent(this.value),
      dataType: 'json',
      success: function(json) {
        console.log(json);
        $('#filter_id').html(json['options']);
        }
      });*/

});
$('#filter_id').on('click','input',function(){
  //console.log(this);

 
  $('#filterseo_filters').append('<div id="filterseo_filters' + $(this).val() + '"><i class="fa fa-minus-circle"></i> ' +  $(this).attr('data-name') + '<input type="hidden" name="filterseo_filters[]" value="' + $(this).val() + '" /></div>');
  //$(this).val();

});

// Filter
$('input[name=\'filter\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: 'index.php?route=catalog/filter/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
      dataType: 'json',
      success: function(json) {
        response($.map(json, function(item) {
          return {
            label: item['name'],
            value: item['filter_id']
          }
        }));
      }, error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
      }
    });
  },
  'select': function(item) {
    $('input[name=\'filter\']').val('');

    $('#filterseo_filters' + item['value']).remove();

    $('#filterseo_filters').append('<div id="filterseo_filters' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="filterseo_filters[]" value="' + item['value'] + '" /></div>');
  }
});

$('#filterseo_filters').delegate('.fa-minus-circle', 'click', function() {
  $(this).parent().remove();
});

/*$('#savecopy').click(function() {
    var oldaction=$('#form-category').attr('action');
    oldaction=oldaction.replace('/edit','/add');
    $('#form-category').attr('action', oldaction);    
    $('#savebtn').click();
});*/
//--></script> 
  <script type="text/javascript"><!--
$('#language a:first').tab('show');
//--></script>
  <?php foreach ($all_question as $q) { ?>
  <?php foreach ($q['question_description'] as $language_id => $lang) { ?>
  <div class="question_id_text_<?php echo $q['question_id']; ?>_<?php echo $language_id; ?> hidden"><?php echo $lang['text']; ?></div>
  <div class="question_id_name_<?php echo $q['question_id']; ?>_<?php echo $language_id; ?> hidden"><?php echo $lang['name']; ?></div>
  <?php } ?>
  <?php } ?>


  <script>
    question_row2 = 0;
    <?php foreach ($questions as $question) { ?>
    <?php if(isset($question['question_description'])){ ?>
      <?php foreach ($languages as $language) { ?>
          ckeditorInit('input-question['+question_row2+']<?php echo $language['language_id']; ?>', '<?php echo $token; ?>');
        <?php } ?>
        question_row2++;
      <?php } ?>
    <?php } ?>

    $('#question-value').on('change','select',function(){
    <?php foreach ($languages as $language) { ?>
        question_id = $(this).find('option:selected').val();
        text = decodeHtml($('.question_id_text_'+question_id+'_<?php echo $language['language_id']; ?>').html());
        name = decodeHtml($('.question_id_name_'+question_id+'_<?php echo $language['language_id']; ?>').html());
        id = 'input-question['+$(this).data('row')+']<?php echo $language['language_id']; ?>';
        CKEDITOR.instances[id].setData(text);
        $('input[name="question['+$(this).data('row')+'][question_description][<?php echo $language['language_id']; ?>][name]"]').val(name);
      <?php } ?>
    });

    function decodeHtml(str)
    {
      var map =
              {
                '&amp;': '&',
                '&lt;': '<',
                '&gt;': '>',
                '&quot;': '"',
                '&#039;': "'"
              };
      return str.replace(/&amp;|&lt;|&gt;|&quot;|&#039;/g, function(m) {return map[m];});
    }

    question_row = <?php echo $question_row; ?>;

    function addQuestion(){

      html = '<tr id="question-row'+question_row +'">';
      html += '<td class="text-left">';
      html += '<select name="question['+question_row+'][question_id]" data-row="'+question_row+'" class="form-control" onchange="/*changeQuestion(this)*/">';
      html += '<option value="" selected>Не выбрано</option>';
    <?php foreach ($all_question as $q) { ?>
        html += '<option value="<?php echo $q['question_id']; ?>"><?php echo $q['name']; ?></option>';
      <?php } ?>
      html += '</select>';
      html += '  <input type="hidden" name="question['+question_row+'][config]" value="" />';
    <?php foreach ($languages as $language) { ?>
        html += '  <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>';
        html += '  <input type="text" name="question['+question_row+'][question_description][<?php echo $language['language_id']; ?>][name]" value="" placeholder="" class="form-control" />';
        html += '  </div>';
      <?php } ?>
      html += '</td>';

      html += '<td class="text-left">';
    <?php foreach ($languages as $language) { ?>
        html += '  <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>';
        html += '  <textarea name="question['+question_row+'][question_description][<?php echo $language['language_id']; ?>][text]" id="input-question['+question_row+']<?php echo $language['language_id']; ?>"  placeholder="" class="form-control" ></textarea>';
        html += '  </div>';
      <?php } ?>
      html += '</td>';
      html += '<td class="text-left"><button type="button" onclick="$(\'#question-row<?php echo $question_row; ?>\').remove();" data-toggle="tooltip" title="Удалить" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
      html += '</tr>';
      $('#question-value tbody').append(html);
    <?php foreach ($languages as $language) { ?>
        ckeditorInit('input-question['+question_row+']<?php echo $language['language_id']; ?>', '<?php echo $token; ?>');
      <?php } ?>
      question_row++;

    }
  </script>
</div>
<?php echo $footer; ?>