<?php

class MediaUpload extends Database
{
    private static $error = array(
        0 => '',
        1 => 'Filens størrelse overskrider \'upload_max_filesize\' directivet i php.ini.',
        2 => 'Filen størrelse overskride \'MAX_FILE_SIZE\' directivet i HTML formen.',
        3 => 'File blev kun delvis uploadet.',
        4 => 'Filen blev ikke uploaded.',
        6 => 'Kunne ikke finde \'tmp\' mappen.',
        7 => 'Kunne ikke gemme filen på disken.',
        8 => 'A PHP extension stopped the file upload.',
        9 => 'Filtypen er ikke tilladt at uploade!'
    );
    private static $mimeType = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
    private static $uploadFolder = '../assets/media/';

    public static function UploadImage(string $inputName, array $sizes = [])
    {
        if(array_key_exists($inputName, $_FILES)){
            if($_FILES[$inputName]['error'] === 0 && $_FILES[$inputName]['size'] > 0){
                $file = $_FILES[$inputName];
                $imageData = getimagesize($file['tmp_name']);
               
                if(!in_array($imageData['mime'], self::$mimeType)){
                    return [
                        'err' => true,
                        'data' => 'Filtypen er ikke tilladt.'
                    ];
                }
        
                if(!file_exists(self::$uploadFolder)){
                    mkdir(self::$uploadFolder, 0755, true);
                }
        
                $fileName = time() . '_' . substr($file['name'], strrpos($file['name'], '.', -10), 10);
                $fileName = str_replace(' ', '', $fileName) . str_replace('image/', '.', $imageData['mime']);
                if(sizeof($sizes) > 0){
                    
                }else{
                    try
                    {
                        if(move_uploaded_file($file['tmp_name'], self::$uploadFolder . $fileName)){
                            (new self)->query("INSERT INTO media (mediaFilename, mediaType)VALUES(:FNAME, :FTYPE);", 
                            [
                                ":FNAME" => $fileName,
                                ":FTYPE" => $imageData['mime']
                            ]);
                            $media = (new self)->query("SELECT mediaId FROM media WHERE mediaId = LAST_INSERT_ID()")->fetch();
                            return ['err' => false, 'data' => $media->mediaId];
                        }
                    }catch(Exception $err)
                    {
                        unlink(self::$uploadFolder.$fileName);
                        return ['err' => true, 'data' => 'Fejl!']; 
                    }
                }
    
            }else{
                return [
                    'err' => true,
                    'data' => 'Filen ' . $_FILES[$inputName]['name'] . ' kunne ikke uploades til serveren! Fejlkode ' . $_FILES[$inputName]['error'] . ' - ' . self::$error[$_FILES[$inputName]['error']]
                ];
            }
            return ['err' => false, 'data' => 'Ingen filer sendt med! $_FILES er tomt'];
        }
    }
}