<?php
class ModelToolImage extends Model {
	public function resize($filename, $width, $height) {
		if (!is_file(DIR_IMAGE . $filename)) {
			return;
		}

		$extension = pathinfo($filename, PATHINFO_EXTENSION);
		if (strtolower($extension) == 'svg') {
			$image_new = $filename;
		} else {

			$old_image = $filename;
			$image_new = 'cache/' . utf8_substr($filename, 0, utf8_strrpos($filename, '.')) . '-' . $width . 'x' . $height . '.' . $extension;

			if (!is_file(DIR_IMAGE . $image_new) || (filectime(DIR_IMAGE . $old_image) > filectime(DIR_IMAGE . $image_new))) {
				$path = '';

				$directories = explode('/', dirname(str_replace('../', '', $image_new)));

				foreach ($directories as $directory) {
					$path = $path . '/' . $directory;

					if (!is_dir(DIR_IMAGE . $path)) {
						@mkdir(DIR_IMAGE . $path, 0777);
					}
				}

				list($width_orig, $height_orig) = getimagesize(DIR_IMAGE . $old_image);

				if ($width_orig != $width || $height_orig != $height) {
					$image = new Image(DIR_IMAGE . $old_image);
					$image->resize($width, $height);
					$image->save(DIR_IMAGE . $image_new);
				} else {
					copy(DIR_IMAGE . $old_image, DIR_IMAGE . $image_new);
				}
			}
		}
		if ($this->request->server['HTTPS']) {
			return HTTPS_CATALOG . 'image/' . $image_new;
		} else {
			return HTTP_CATALOG . 'image/' . $image_new;
		}
	}
}