<?php

class ModelToolImage extends Model {

    public function isImageExists($image) {
        if ($image && (USE_EXTERNAL_STATIC_SERVER || file_exists(DIR_IMAGE . $image))) {
            return true;
        }
        return false;
    }

    public function resize($filename, $width, $height) {
        if (USE_EXTERNAL_STATIC_SERVER) {
            $imageUrlPart = utf8_substr($filename, 0, utf8_strrpos($filename, '.')) . '-' . (int)$width . 'x' . (int)$height;
            $externalImage = EXTERNAL_STATIC_SERVER . 'image/cachewebp/' . $imageUrlPart . '.webp';
            return $externalImage;
        }

        if (!is_file(DIR_IMAGE . $filename)) {
            return;
        }

        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $imageUrlPart = utf8_substr($filename, 0, utf8_strrpos($filename, '.')) . '-' . (int)$width . 'x' . (int)$height;
        if (strtolower($extension) == 'svg') {
            $new_image = $filename;
        } else {
        	$old_image = $filename;
			$new_image = 'cache/' . utf8_substr($filename, 0, utf8_strrpos($filename, '.')) . '-' . $width . 'x' . $height . '.' . $extension;
	        $new_image_webp = 'cachewebp/' . utf8_substr($filename, 0, utf8_strrpos($filename, '.')) . '-' . (int)$width . 'x' . (int)$height . '.webp';

			if (!is_file(DIR_IMAGE . $new_image) || (filectime(DIR_IMAGE . $old_image) > filectime(DIR_IMAGE . $new_image))) {
				$path = '';

				$directories = explode('/', dirname(str_replace('../', '', $new_image)));

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
					$image->save(DIR_IMAGE . $new_image);
				} else {
					copy(DIR_IMAGE . $old_image, DIR_IMAGE . $new_image);
				}
			}

			$imagepath_parts = explode('/', $new_image);
			$new_image = implode('/', array_map('rawurlencode', $imagepath_parts));
			$new_image2 = implode('/',$imagepath_parts);

	        $gd = gd_info();
	        if ($gd['WebP Support']) {
	            if (file_exists(DIR_IMAGE . $new_image_webp) && !is_file(DIR_IMAGE . $new_image_webp) || file_exists(filectime(DIR_IMAGE . $new_image2)) && (filectime(DIR_IMAGE . $new_image2) > filectime(DIR_IMAGE . $new_image_webp))) {

	                $path = '';

	                $directories = explode('/', dirname($new_image_webp));

	                foreach ($directories as $directory) {
	                    $path = $path . '/' . $directory;

	                    if (!is_dir(DIR_IMAGE . $path)) {
	                        @mkdir(DIR_IMAGE . $path, 0777);
	                    }
	                }

	                $image_webp = new Image(DIR_IMAGE . $old_image);
	                $image_webp->resize($width, $height);
	                $image_webp->save_webp(DIR_IMAGE . $new_image_webp);
	            }
	        }
	    }

        if ($this->request->server['HTTPS']) {
            return $this->config->get('config_ssl') . 'image/' . $new_image;
        } else {
            return $this->config->get('config_url') . 'image/' . $new_image;
        }
    }
}
