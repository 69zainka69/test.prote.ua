<?

require_once('/var/www/prote/data/www/prote.ua/config.php');
include_once(DIR_ROOT.'cron/class/axapta.php');
include_once(DIR_ROOT.'cron/class/prote.php');

$axapta = new Axapta();
$prote = new Prote();

// обновление рисунков и документов
$ax_documents = $axapta->getProductDocuments();
$new_ax_documents = array();
$count=0;
foreach ($ax_documents as $key => $document) {

	$count++;
	$new_ax_documents[$document['ItemId']][$document['TypeId']][] = $document['FileName'];

}

$product_images = $prote->getProductImages();
$count=0;

if($product_images){
	echo "copy image\n";
	foreach ($product_images as $image) {

		$foto_ax = DIR_AX_DOCS_IMAGE.$image['ax_filename'];
	
		if (file_exists($foto_ax) && $image['image']) {
			
			$image_old = $foto_ax;
		    $image_new = $image['image'];

		    copyImage($image_old,$image_new);
		}

	}
}

$product_docs = $prote->getProductDocList();

if($product_docs){
	echo "copy files\n";
	foreach ($product_docs as $doc) {
		
		if(strpos($doc['file'],'/user/files/')!==false){
			
			if (file_exists($file_old = DIR_AX_DOCS_MANUAL.$doc['ax_filename'])) {
				copyFile($file_old,$doc['alias']);
			} else if (file_exists($file_old = DIR_AX_DOCS.$doc['ax_filename'])) {
				copyFile($file_old,$doc['alias']);
			}

		}elseif(strpos($doc['file'],'/user/import/')!==false){

			$file_old = DIR_AX_DOCS_CERTIFICATE.$doc['ax_filename'];
			copyFile($file_old,$doc['alias']);

		}

	}
}
echo "\n";


function copyImage($image_old,$image_new){
	if (!is_file(DIR_IMAGE . $image_new) || (filemtime($image_old) > filemtime(DIR_IMAGE . $image_new))) {

		$path = '';
		$directories = explode('/', dirname($image_new));
		foreach ($directories as $directory) {
			$path = $path . '/' . $directory;

			if (!is_dir(DIR_IMAGE . $path)) {
				@mkdir(DIR_IMAGE . $path, 0777);
			}
		}
		copy($image_old, DIR_IMAGE . $image_new);
		echo '#';
	}
}

function copyFile($file_old,$file_new){

	if (!is_file(DIR_FILE . $file_new) || (filemtime($file_old) > filemtime(DIR_FILE . $file_new))) {
		copy($file_old, DIR_FILE . $file_new);
		echo '#';
	}
}


/*echo "<pre>";
print_r($documents);
echo "</pre>";*/