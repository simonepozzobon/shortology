<?php
    require_once(dirname(__FILE__).'/../boot.php');
    $backupDirectory = SGConfig::get('SG_BACKUP_DIRECTORY');
    $maxUploadSize = ini_get('upload_max_filesize');
?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title"><?php _backupGuardT('Import from')?></h4>
        </div>
        <div class="modal-body sg-modal-body" id="sg-modal-inport-from">
            <div class="col-md-12" id="modal-import-2">
                <div class="form-group">
                    <label class="col-md-2 control-label sg-upload-label" for="textinput"><?php _backupGuardT('SGBP file')?></label>
                    <div class="col-md-10">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <span class="btn btn-primary btn-file">
                                    <?php _backupGuardT('Browse')?>&hellip; <input class="sg-backup-upload-input" type="file" name="files[]" data-url="<?php echo admin_url('admin-ajax.php')."?action=backup_guard_importBackup" ?>" data-max-file-size="<?php echo backupGuardConvertToBytes($maxUploadSize.'B'); ?>" multiple>
                                </span>
                            </span>
                            <input type="text" class="form-control" readonly>
                        </div>
                        <br/>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _backupGuardT("Close")?></button>
            <button type="button" data-remote="importBackup" id="uploadSgbpFile" class="btn btn-primary"><?php echo _backupGuardT('Import')?></button>
        </div>
    </div>
</div>
