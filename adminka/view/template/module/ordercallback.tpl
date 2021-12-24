<?php echo $header; ?> <?php echo $column_left; ?>
<div id="content">



   <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">

    <div class="breadcrumb">
      <?php foreach ($breadcrumbs as $breadcrumb) { ?>
      <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
      <?php } ?>
    </div>
    <?php if ($error_warning) { ?>
        <div class="warning"><?php echo $error_warning; ?></div>
    <?php } ?>
  </div>
  </div>
  </div>
	<div class="box"> 
        <div class="heading">
            <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
            <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
        </div>
	  
	    <div class="content">
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
                <div id="settings" class="htabs">
                    <a href="#tab-common"><?php echo $tab_text_common; ?></a>
                    <a href="#tab-fields"><?php echo $tab_text_fields; ?></a>
                </div>

                <div id="tab-common">
                    <table class="form">
                        <tr>
                            <td><?php echo $entry_use_module; ?></td>
                            <td class="left">
                                <select name="ordercallback_use_module">
                                    <?php if ($ordercallback_use_module == 1) { ?>
                                        <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                        <option value="0"><?php echo $text_disabled; ?></option>
                                    <?php } else { ?>
                                        <option value="1"><?php echo $text_enabled; ?></option>
                                        <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td><?php echo $entry_module_works_as; ?></td>
                            <td>
                              <select name="ordercallback_module_works_as">
                                  <option value="call" <?php echo ($module_works_as == 'call' ? 'selected' : ''); ?>><?php echo $text_module_works_as_call; ?></option>
                                  <option value="order" <?php echo ($module_works_as == 'order' ? 'selected' : ''); ?>><?php echo $text_module_works_as_order; ?></option>
                              </select>
                            </td>
                        </tr>

                        <tr>
                            <td><?php echo $entry_button_caption; ?></td>
                            <td><input type="text" name="ordercallback_button_caption" value="<?php echo $button_caption; ?>" /></td>
                        </tr>

                        <tr>
                            <td><?php echo $entry_send_notification_to_email; ?></td>
                            <td class="left">
                                <select name="ordercallback_send_notification_to_email">
                                    <?php if ($send_notification_to_email == 1) { ?>
                                        <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                                        <option value="0"><?php echo $text_no; ?></option>
                                    <?php } else { ?>
                                        <option value="1"><?php echo $text_yes; ?></option>
                                        <option value="0" selected="selected"><?php echo $text_no; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td><?php echo $entry_send_notification_to_sms; ?></td>
                            <td class="left">
                                <select name="ordercallback_send_notification_to_email" disabled>
                                    <?php if ($send_notification_to_sms == 1) { ?>
                                        <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                                        <option value="0"><?php echo $text_no; ?></option>
                                    <?php } else { ?>
                                        <option value="1"><?php echo $text_yes; ?></option>
                                        <option value="0" selected="selected"><?php echo $text_no; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>

                <div id="tab-fields">
                    <table class="form">
                        <tr>
                            <td><?php echo $entry_field_name_show; ?></td>
                            <td class="left">
                                <select name="ordercallback_field_name_show">
                                    <?php if ($field_name_show == 1) { ?>
                                        <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                                        <option value="0"><?php echo $text_no; ?></option>
                                    <?php } else { ?>
                                        <option value="1"><?php echo $text_yes; ?></option>
                                        <option value="0" selected="selected"><?php echo $text_no; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td><?php echo $entry_field_name_required; ?></td>
                            <td class="left">
                                <select name="ordercallback_field_name_required">
                                    <?php if ($field_name_required == 1) { ?>
                                        <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                                        <option value="0"><?php echo $text_no; ?></option>
                                    <?php } else { ?>
                                        <option value="1"><?php echo $text_yes; ?></option>
                                        <option value="0" selected="selected"><?php echo $text_no; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td><?php echo $entry_field_phone_show; ?></td>
                            <td class="left">
                                <select name="ordercallback_field_phone_show">
                                    <?php if ($field_phone_show == 1) { ?>
                                        <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                                        <option value="0"><?php echo $text_no; ?></option>
                                    <?php } else { ?>
                                        <option value="1"><?php echo $text_yes; ?></option>
                                        <option value="0" selected="selected"><?php echo $text_no; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td><?php echo $entry_field_phone_required; ?></td>
                            <td class="left">
                                <select name="ordercallback_field_phone_required">
                                    <?php if ($field_phone_required == 1) { ?>
                                        <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                                        <option value="0"><?php echo $text_no; ?></option>
                                    <?php } else { ?>
                                        <option value="1"><?php echo $text_yes; ?></option>
                                        <option value="0" selected="selected"><?php echo $text_no; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td><?php echo $entry_field_email_show; ?></td>
                            <td class="left">
                                <select name="ordercallback_field_email_show">
                                    <?php if ($field_email_show == 1) { ?>
                                        <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                                        <option value="0"><?php echo $text_no; ?></option>
                                    <?php } else { ?>
                                        <option value="1"><?php echo $text_yes; ?></option>
                                        <option value="0" selected="selected"><?php echo $text_no; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td><?php echo $entry_field_email_required; ?></td>
                            <td class="left">
                                <select name="ordercallback_field_email_required">
                                    <?php if ($field_email_required == 1) { ?>
                                        <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                                        <option value="0"><?php echo $text_no; ?></option>
                                    <?php } else { ?>
                                        <option value="1"><?php echo $text_yes; ?></option>
                                        <option value="0" selected="selected"><?php echo $text_no; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td><?php echo $entry_field_comment_show; ?></td>
                            <td class="left">
                                <select name="ordercallback_field_comment_show">
                                    <?php if ($field_comment_show == 1) { ?>
                                        <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                                        <option value="0"><?php echo $text_no; ?></option>
                                    <?php } else { ?>
                                        <option value="1"><?php echo $text_yes; ?></option>
                                        <option value="0" selected="selected"><?php echo $text_no; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td><?php echo $entry_field_comment_required; ?></td>
                            <td class="left">
                                <select name="ordercallback_field_comment_required">
                                    <?php if ($field_comment_required == 1) { ?>
                                        <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                                        <option value="0"><?php echo $text_no; ?></option>
                                    <?php } else { ?>
                                        <option value="1"><?php echo $text_yes; ?></option>
                                        <option value="0" selected="selected"><?php echo $text_no; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td><?php echo $entry_field_phone_mask; ?><br><span class="help"><?php echo $entry_field_phone_mask_help; ?></span></td>
                            <td class="left">
                                <input type="text" name="ordercallback_field_phone_mask" value="<?php echo $field_phone_mask; ?>"  size="30" />
                            </td>
                        </tr>

                        <tr>
                            <td><?php echo $entry_email_text; ?><br><span class="help"><?php echo $entry_email_text_help; ?></span></td>
                            <td class="left">
                                <textarea rows="5" cols="40" name="ordercallback_email_text"><?php echo $email_text; ?></textarea>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
	    </div>
	</div>
</div>

<script type="text/javascript"><!--
    $(document).ready(function() {
		$('#settings a').tabs();
	});
//--></script>
<?php echo $footer; ?>