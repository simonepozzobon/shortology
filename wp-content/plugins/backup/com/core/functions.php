<?php

function backupGuardConvertDateTimezone($date, $dateFormat = "Y-m-d H:i:s", $timezone = "UTC")
{
	if (in_array($timezone, timezone_identifiers_list())) {
		$date = date_create($date);
		$timezone = timezone_open($timezone);
		date_timezone_set($date, $timezone);

		if (!$dateFormat) {
			$dateFormat = "Y-m-d H:i:s";
		}

		return date_format($date, $dateFormat);
	}

	return $date;
}

function backupGuardRemoveSlashes($value)
{
	if (SG_ENV_ADAPTER == SG_ENV_WORDPRESS) {
		return wp_unslash($value);
	}
	else {
		if (is_array($value)) {
			return array_map('stripslashes', $value);
		}

		return stripslashes($value);
	}
}

function backupGuardSanitizeTextField($value)
{
	if (SG_ENV_ADAPTER == SG_ENV_WORDPRESS) {
		if (is_array($value)) {
			return array_map('sanitize_text_field', $value);
		}

		return sanitize_text_field($value);
	}
	else {
		if (is_array($value)) {
			return array_map('strip_tags', $value);
		}

		return strip_tags($value);
	}
}

function backupGuardIsMultisite()
{
	if (SG_ENV_ADAPTER == SG_ENV_WORDPRESS) {
		return defined('BG_IS_MULTISITE')?BG_IS_MULTISITE:is_multisite();
	}
	else {
		return false;
	}
}

function backupGuardGetBanner($env)
{
	require_once(SG_LIB_PATH.'BackupGuard/Client.php');
	$client = new BackupGuard\Client();
	return $client->getBanner(strtolower($env));
}

function backupGuardGetFilenameOptions($options)
{
	$selectedPaths = explode(',', $options['SG_BACKUP_FILE_PATHS']);
	$pathsToExclude = explode(',', $options['SG_BACKUP_FILE_PATHS_EXCLUDE']);

	$opt = '';

	if (SG_ENV_ADAPTER == SG_ENV_WORDPRESS) {
		$opt .= 'opt(';

		if ($options['SG_BACKUP_TYPE'] == SG_BACKUP_TYPE_CUSTOM) {
			if ($options['SG_ACTION_BACKUP_DATABASE_AVAILABLE']) {
				$opt .= 'db_';
			}

			if ($options['SG_ACTION_BACKUP_FILES_AVAILABLE']) {
				if (in_array('wp-content', $selectedPaths)) {
					$opt .= 'wpc_';
				}
				if (!in_array('wp-content/plugins', $pathsToExclude)) {
					$opt .= 'plg_';
				}
				if (!in_array('wp-content/themes', $pathsToExclude)) {
					$opt .= 'thm_';
				}
				if (!in_array('wp-content/uploads', $pathsToExclude)) {
					$opt .= 'upl_';
				}
			}


		}
		else {
			$opt .= 'full';
		}

		$opt = trim($opt, "_");
		$opt .= ')_';
	}

	return $opt;
}

function backupGuardGenerateToken()
{
	return md5(time());
}

// Parse a URL and return its components
function backupGuardParseUrl($url)
{
	$urlComponents = parse_url($url);
	$domain = $urlComponents['host'];
	$port = '';

	if (isset($urlComponents['port']) && strlen($urlComponents['port'])) {
		$port = ":".$urlComponents['port'];
	}

	$domain = preg_replace("/(www|\dww|w\dw|ww\d)\./", "", $domain);

	$path = "";
	if (isset($urlComponents['path'])) {
	    $path = $urlComponents['path'];
	}

	return $domain.$port.$path;
}

function backupGuardIsReloadEnabled()
{
	// Check if reloads option is turned on
	return SGConfig::get('SG_BACKUP_WITH_RELOADINGS')?true:false;
}

function backupGuardGetBackupOptions($options)
{
	$backupOptions = array(
		'SG_BACKUP_UPLOAD_TO_STORAGES' => '',
		'SG_BACKUP_FILE_PATHS_EXCLUDE' => '',
		'SG_BACKUP_FILE_PATHS' => ''
	);

	//If background mode
	$isBackgroundMode = !empty($options['backgroundMode']) ? 1 : 0;

	if ($isBackgroundMode) {
		$backupOptions['SG_BACKUP_IN_BACKGROUND_MODE'] = $isBackgroundMode;
	}

	//If cloud backup
	if (!empty($options['backupCloud']) && count($options['backupStorages'])) {
		$clouds = $options['backupStorages'];
		$backupOptions['SG_BACKUP_UPLOAD_TO_STORAGES'] = implode(',', $clouds);
	}

	$backupOptions['SG_BACKUP_TYPE'] = $options['backupType'];

	if ($options['backupType'] == SG_BACKUP_TYPE_FULL) {
		$backupOptions['SG_ACTION_BACKUP_DATABASE_AVAILABLE']= 1;
		$backupOptions['SG_ACTION_BACKUP_FILES_AVAILABLE'] = 1;
		$backupOptions['SG_BACKUP_FILE_PATHS_EXCLUDE'] = SG_BACKUP_FILE_PATHS_EXCLUDE;
		$backupOptions['SG_BACKUP_FILE_PATHS'] = 'wp-content';
	}
	else if ($options['backupType'] == SG_BACKUP_TYPE_CUSTOM) {
		//If database backup
		$isDatabaseBackup = !empty($options['backupDatabase']) ? 1 : 0;
		$backupOptions['SG_ACTION_BACKUP_DATABASE_AVAILABLE'] = $isDatabaseBackup;

		//If files backup
		if (!empty($options['backupFiles']) && count($options['directory'])) {
			$backupFiles = explode(',', SG_BACKUP_FILE_PATHS);
			$filesToExclude = @array_diff($backupFiles, $options['directory']);

			if (in_array('wp-content', $options['directory'])) {
				$options['directory'] = array('wp-content');
			}
			else {
				$filesToExclude = array_diff($filesToExclude, array('wp-content'));
			}

			$filesToExclude = implode(',', $filesToExclude);
			if (strlen($filesToExclude)) {
				$filesToExclude = ','.$filesToExclude;
			}

			$backupOptions['SG_BACKUP_FILE_PATHS_EXCLUDE'] = SG_BACKUP_FILE_PATHS_EXCLUDE.$filesToExclude;
			$options['directory'] = backupGuardSanitizeTextField($options['directory']);
			$backupOptions['SG_BACKUP_FILE_PATHS'] = implode(',', $options['directory']);
			$backupOptions['SG_ACTION_BACKUP_FILES_AVAILABLE'] = 1;
		}
		else {
			$backupOptions['SG_ACTION_BACKUP_FILES_AVAILABLE'] = 0;
			$backupOptions['SG_BACKUP_FILE_PATHS'] = 0;
		}
	}
	return $backupOptions;
}

function backupGuardLoadStateData()
{
	if (file_exists(SG_BACKUP_DIRECTORY.SG_STATE_FILE_NAME)) {
		$sgState = new SGState();
		$stateFile = file_get_contents(SG_BACKUP_DIRECTORY.SG_STATE_FILE_NAME);
		$sgState = $sgState->factory($stateFile);
		return $sgState;
	}

	return false;
}

function backupGuardGetStorageNameById($storageId)
{
	$storageName = '';
	switch ($storageId) {
		case SG_STORAGE_FTP:
			$storageName = 'FTP';
			break;
		case SG_STORAGE_DROPBOX:
			$storageName = 'Dropbox';
			break;
		case SG_STORAGE_GOOGLE_DRIVE:
			$storageName = 'Google Drive';
			break;
		case SG_STORAGE_AMAZON:
			$storageName = 'Amazon S3';
			break;
		case SG_STORAGE_ONE_DRIVE:
			$storageName = "One Drive";
			break;
	}

	return $storageName;
}

function backupGuardOutdatedBackupsCleanup($path)
{
	if (SGBoot::isFeatureAvailable('NUMBER_OF_BACKUPS_TO_KEEP')) {
		$amountOfBackupsToKeep = SGConfig::get('SG_AMOUNT_OF_BACKUPS_TO_KEEP')?SGConfig::get('SG_AMOUNT_OF_BACKUPS_TO_KEEP'):SG_NUMBER_OF_BACKUPS_TO_KEEP;
		$backups = backupGuardScanBackupsDirectory($path);
		while (count($backups) > $amountOfBackupsToKeep) {
			$backup = key($backups);
			array_shift($backups);
			SGBackup::deleteBackup($backup);
		}
	}
}

function backupGuardValidateApiCall($token)
{
	if (!strlen($token)) {
		exit();
	}

	$statePath = SG_BACKUP_DIRECTORY.SG_STATE_FILE_NAME;

	if (!file_exists($statePath)) {
		exit();
	}

	$state = file_get_contents($statePath);
	$state = json_decode($state, true);
	$stateToken = $state['token'];

	if ($stateToken != $token) {
		exit();
	}

	return true;
}

function backupGuardScanBackupsDirectory($path)
{
	$backups = scandir($path);
	$backupFolders = array();
	foreach ($backups as $key => $backup) {
		if ($backup == "." || $backup == "..") {
			continue;
		}

		if (is_dir($path.$backup)) {
			$backupFolders[$backup] = filemtime($path.$backup);
		}
	}
	// Sort(from low to high) backups by creation date
	asort($backupFolders);
	return $backupFolders;
}

function backupGuardSymlinksCleanup($dir)
{
	if (is_dir($dir)) {
		$objects = scandir($dir);
		foreach ($objects as $object) {
			if ($object == "." || $object == "..") {
				continue;
			}

			if (filetype($dir.$object) != "dir") {
				@unlink($dir.$object);
			}
			else {
				backupGuardSymlinksCleanup($dir.$object.'/');
				@rmdir($dir.$object);
			}
		}
	}
	else {
		@unlink($dir);
	}
	return;
}

function backupGuardRealFilesize($filename)
{
	$fp = fopen($filename, 'r');
	$return = false;
	if (is_resource($fp))
	{
		if (PHP_INT_SIZE < 8) // 32 bit
		{
			if (0 === fseek($fp, 0, SEEK_END))
			{
				$return = 0.0;
				$step = 0x7FFFFFFF;
				while ($step > 0)
				{
					if (0 === fseek($fp, - $step, SEEK_CUR))
					{
						$return += floatval($step);
					}
					else
					{
						$step >>= 1;
					}
				}
			}
		}
		else if (0 === fseek($fp, 0, SEEK_END)) // 64 bit
		{
			$return = ftell($fp);
		}
	}

	return $return;
}

function backupGuardFormattedDuration($startTs, $endTs)
{
	$unit = 'seconds';
	$duration = $endTs-$startTs;
	if ($duration>=60 && $duration<3600)
	{
		$duration /= 60.0;
		$unit = 'minutes';
	}
	else if ($duration>=3600)
	{
		$duration /= 3600.0;
		$unit = 'hours';
	}
	$duration = number_format($duration, 2, '.', '');

	return $duration.' '.$unit;
}

function backupGuardDeleteDirectory($dirName)
{
	$dirHandle = null;
	if (is_dir($dirName))
	{
		$dirHandle = opendir($dirName);
	}

	if (!$dirHandle)
	{
		return false;
	}

	while ($file = readdir($dirHandle))
	{
		if ($file != "." && $file != "..")
		{
			if (!is_dir($dirName."/".$file))
			{
				@unlink($dirName."/".$file);
			}
			else
			{
				backupGuardDeleteDirectory($dirName.'/'.$file);
			}
		}
	}

	closedir($dirHandle);
	return @rmdir($dirName);
}

function backupGuardDownloadFile($file, $type = 'application/octet-stream')
{
	$file = backupGuardRemoveSlashes($file);
	if (file_exists($file)) {
		header('Content-Description: File Transfer');
		header('Content-Type: '.$type);
		header('Content-Disposition: attachment; filename="'.basename($file).'";');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($file));
		readfile($file);
	}

	exit;
}

function backupGuardDownloadFileSymlink($safedir, $filename)
{
	$safedir  = backupGuardRemoveSlashes($safedir);
	$filename = backupGuardRemoveSlashes($filename);

	$downloaddir = SG_SYMLINK_PATH;
	$downloadURL = SG_SYMLINK_URL;

	if (!file_exists($downloaddir)) {
		mkdir($downloaddir, 0777);
	}

	$letters = 'abcdefghijklmnopqrstuvwxyz';
	srand((double) microtime() * 1000000);
	$string = '';

	for ($i = 1; $i <= rand(4,12); $i++) {
	   $q = rand(1,24);
	   $string = $string.$letters[$q];
	}

	$handle = opendir($downloaddir);
	while ($dir = readdir($handle)) {
		if ($dir == "." || $dir == "..") {
			continue;
		}

		if (is_dir($downloaddir.$dir)) {
			@unlink($downloaddir . $dir . "/" . $filename);
			@rmdir($downloaddir . $dir);
		}
	}

	closedir($handle);

	mkdir($downloaddir . $string, 0777);
	$res = @symlink($safedir . $filename, $downloaddir . $string . "/" . $filename);
	if ($res) {
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Content-Transfer-Encoding: binary');
		header("Location: " . $downloadURL . $string . "/" . $filename);
	}
	else{
		wp_die('Symlink / shortcut creation failed! Seems your server configurations don’t allow symlink creation, so we’re unable to provide you the direct download url. You can download your backup using any FTP client. All backups and related stuff we locate “/wp-content/uploads/backup-guard” directory. If you need this functionality, you should check out your server configurations and make sure you don’t have any limitation related to symlink creation.');
	}
	exit;
}

function backupGuardGetCurrentUrlScheme()
{
	return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')?'https':'http';
}

function backupGuardValidateLicense()
{
	if (!SGBoot::isFeatureAvailable('SCHEDULE')) {
		return true;
	}

	//only check once per day
	$ts = (int)SGConfig::get('SG_LICENSE_CHECK_TS');
	if (time() - $ts < SG_LICENSE_CHECK_TIMEOUT) {
		return true;
	}

	require_once(SG_LIB_PATH.'SGAuthClient.php');

	$url = site_url();

	$auth = SGAuthClient::getInstance();
	$res = $auth->validateUrl($url);

	if ($res === -1) { //login is required
		backup_guard_login_page();
		return false;
	}
	else if ($res === false) { //invalid license
		backup_guard_link_license_page();
		return false;
	}
	else {
		SGConfig::set('SG_LICENSE_CHECK_TS', time(), true);
		SGConfig::set('SG_LICENSE_KEY', $res, true);
	}

	return true;
}

function backupGuardCheckUpdatesAvailable()
{
	$updatePlugins = get_site_transient('update_plugins');
	if(isset($updatePlugins->response) && count($updatePlugins->response) > 0) {
		return true;
	}
	$updateThemes = get_site_transient('update_themes');
	if(isset($updateThemes->response) && count($updateThemes->response) > 0) {
		return true;
	}
	$updateCore = get_site_transient('update_core');
	if($updateCore->updates[0]->response == 'upgrade') {
		return true;
	}
	return false;
}

function backupGuardShowWarningAboutUpdate()
{
	?>
	<style>
		.sg-update-alert-container{
			width: 100%;
			float: left;
			padding-top: 12px;
			padding-bottom: 12px;
			background-color: #fff;
			border-left: 4px solid #ffb900;
			margin-bottom: 10px;
		}

		.sg-update-alert-container .sg-logo-container {
			height: 44px;
			float: left;
			padding-left: 5px;
			padding-right: 5px;
		}

		.sg-update-alert-container .sg-text-container {
			float: left;
			padding-left: 7px;
		}
		.sg-update-alert-container .sg-title {
			font-size: 20px;
		}
		.sg-update-alert-container .sg-text {
			padding-top: 10px;
		}
		.sg-update-alert-container .sg-close-button{
			float: right;
			padding-right: 5px;
			position: relative;
			top: -8px;
		}

	</style>
	<div class="sg-update-alert-container">
		<div class="sg-logo-container">
			<img height="100%" src="<?php echo SG_PUBLIC_URL; ?>img/bg_160.png">
		</div>
		<div class="sg-text-container">
			<div class="sg-title">Wait… Don’t forget to create a backup before updating!</div>
			<div class="sg-text"> You have pending updates which should be installed on your WordPress. <a href="<?php echo SG_PUBLIC_BACKUPS_URL ?>">BackupGuard</a> strongly recommends to create a backup before installing any update package. So, you’ll be safe in case something goes wrong!</div>
		</div>
		<div class="sg-close-button"><input type="button" value="close" onclick="sgCloseUpdateNotification();"/></div>
	</div>
	<script>
		function sgCloseUpdateNotification()
		{
			var disabled = confirm("If you close this notification you won’t receive any alerts from BackupGuard before installing updates.\nAre you sure you want to disable such notifications?");
			if(disabled){
				jQuery(".sg-update-alert-container").remove();
				var data = {
					'action': 'backup_guard_settings',
					'type': 'updateSetting',
					'alert-before-update': '0'
				};
				jQuery.get(ajaxurl, data, function(response) {});
				jQuery(".update-message button").unbind("click",sgAlertBeforeUpdate);
				jQuery(".update-link").unbind("click",sgAlertBeforeUpdate);
				jQuery("form[name='upgrade-themes'], form[name='upgrade-plugins'], form[name='upgrade']").unbind("submit",sgAlertBeforeUpdate)
			}
		}
		function sgAlertBeforeUpdate(){
			var update = confirm("Wait…You see this alert because you’ve enabled “alert to create a backup before updates” option in BackupGuard settings.\nAre you sure you want to continue updating?");
			if(update){
				return true;
			}
			return false;
		}
		(function()
		{
			window.addEventListener("load",function() {
				jQuery(".sg-update-alert-container").insertAfter('.wrap h1:first');
				jQuery("form[name='upgrade-themes'], form[name='upgrade-plugins'], form[name='upgrade']").submit(sgAlertBeforeUpdate);

			});

		})()
	</script>

	<?php
}

function backupGuardOnScreenActivate()
{
	$isAlertBeforeUpdateEnabled = SGConfig::get('SG_ALERT_BEFORE_UPDATE');
	if(!$isAlertBeforeUpdateEnabled){
		return;
	}
	$current_screen = get_current_screen();

	if($current_screen->id === "themes" || $current_screen->id === "plugins") {
		$selector = $current_screen->id === "themes" ? ".update-message button" : ".update-link";
		?>
		<script>
			function sgAlertBeforeUpdate(e) {
				var update = confirm("Wait…You see this alert because you’ve enabled “alert to create a backup before updates” option in BackupGuard settings.\nAre you sure you want to continue updating?");
				if (!update) {
					e.stopPropagation();
					return false;
				}
			}
			(function () {
				window.addEventListener("load", function () {
					jQuery("<?php echo $selector ?>").click(sgAlertBeforeUpdate);
				})
			})()
		</script>
		<?php
		backupGuardShowWarningAboutUpdate();

	}
}

function backupGuardOnUpgradeScreenActivate()
{
	$isAlertBeforeUpdateEnabled = SGConfig::get('SG_ALERT_BEFORE_UPDATE');
	if(!backupGuardCheckUpdatesAvailable()){
		return;
	}
	if ($isAlertBeforeUpdateEnabled) {
		backupGuardShowWarningAboutUpdate();
	}
}

function backupGuardOnBeforeUpdateDownload( $true, $args_hook_extra, $config )
{

	//continue downloading if there are no updates
	if($config->update_count == 0){
		return false;
	}

	//if updating
	//TODO start backup process
	return false;
}

