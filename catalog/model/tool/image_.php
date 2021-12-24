<?php
    class ModelToolImage extends Model {
	public function resize($filename, $width, $height) {
            //if(file_exists(DIR_IMAGE . $filename)){

            //} else {
                $filename = 'no-photo-img.png';
            //}
            if (!is_file(DIR_IMAGE . $filename)) {
                return;
            }

            $extension = pathinfo($filename, PATHINFO_EXTENSION);

            if (strtolower($extension) == 'svg') {
                $image_new = $filename;
            } else {

                $old_image = $filename;
                $image_new = 'cache/' . utf8_substr($filename, 0, utf8_strrpos($filename, '.')) . '-' . $width . 'x' . $height . '.' . $extension;

                // Постепенное Обновление кеша
                // Выставляем дату - все кешированные фоты до которой нужно обновить.
                $cacheupdate=strtotime('2018-03-12');
                // ---------------------------------
                //if(file_exists(DIR_IMAGE . $result['image']))
                if (!is_file(DIR_IMAGE . $image_new) || (filectime(DIR_IMAGE . $image_new) < $cacheupdate) || (filectime(DIR_IMAGE . $old_image) > filectime(DIR_IMAGE . $image_new))) {
                    $path = '';

                    $directories = explode('/', dirname(str_replace('../', '', $image_new)));

                    foreach ($directories as $directory) {
                        $path = $path . '/' . $directory;

                        if (!is_dir(DIR_IMAGE . $path)) {
                                @mkdir(DIR_IMAGE . $path, 0777);
                        }
                    }

                    list($width_orig, $height_orig) = getimagesize(DIR_IMAGE . $old_image);

                    if (($width_orig != $width || $height_orig != $height)) {
                        $image = new Image(DIR_IMAGE . $old_image);
                        $image->resize($width, $height);
                        
                        if ($width>300) {
                            // Странный способ - чтоб изображение нормально наложилось, мы его сначала сохраним,
                            $image->save('/var/www/www-root/data/www/prote-centos.vm.net/tmp/resize-tmp.png');
                            // Затем - прочитаем
                            $image=new Image('/var/www/www-root/data/www/prote-centos.vm.net/tmp/resize-tmp.png');                    
                            // И только потом наложим водяные знаки
                            $stamp = new Image('/var/www/www-root/data/www/prote-centos.vm.net/image/prote-logo-photo.png');
                            $image->watermark($stamp);                        
                            // Временный файл удалим
                            unlink('/var/www/www-root/data/www/prote-centos.vm.net/tmp/resize-tmp.png');
                        }    
                        // 
                        $image->save(DIR_IMAGE . $image_new);
                    } else {
                        copy(DIR_IMAGE . $old_image, DIR_IMAGE . $image_new);
                    }
                }

                $imagepath_parts = explode('/', $image_new);
                $image_new = implode('/', array_map('rawurlencode', $imagepath_parts));
            }

            if ($this->request->server['HTTPS']) {
                return $this->config->get('config_ssl') . 'image/' . $image_new;
            } else {
                return $this->config->get('config_url') . 'image/' . $image_new;
            }
	}
    }
