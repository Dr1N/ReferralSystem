<?php
class Image
{
	private $_uploadedFile;
	public $savedFileName;
	public $errors;
	public $settings = array();
    public $imageFor;

    function __construct($config)
    {
        switch ($config) 
        {
            case 'user':
                $this->imageFor = 'User';
                $this->settings = array_merge(Yii::app()->params['image'], Yii::app()->params['user']);
                break;
            case 'campaign':
                $this->imageFor = 'Campaign';
                $this->settings = array_merge(Yii::app()->params['image'], Yii::app()->params['logo']);
                break;
        }
    }

    public function setFile($filesSource)
    {
        $this->errors = null;
        $this->savedFileName = null;
        $this->_uploadedFile = $filesSource[$this->imageFor];
        $this->_uploadedFile = array(
            'name'     => $this->_uploadedFile['name']['image'],
            'type'     => $this->_uploadedFile['type']['image'],
            'tmp_name' => $this->_uploadedFile['tmp_name']['image'],
            'error'    => $this->_uploadedFile['error']['image'],
            'size'     => $this->_uploadedFile['size']['image'],
        );
    } 
	
	public function saveImage($fileName)
	{
        $result = true;
		$upload = new Upload($this->_uploadedFile);
		$upload->jpeg_quality  = $this->settings['jpegQuality'];
		$upload->no_script     = $this->settings['noScript'];
		$upload->image_resize  = $this->settings['imageResize'];
		$upload->image_x       = $this->settings['imageX'];
		$upload->image_y       = $this->settings['imageY'];
		$upload->image_ratio   = $this->settings['imageRatio'];
		// some vars (!!! UserId)
		$destPath = realpath(Yii::app()->getBasePath() . $this->settings['path']) . '/' ;
		$destName = '';
		// verify if was uploaded
		$upload->file_new_name_body = $fileName;                     
	    $upload->process($destPath);
	    // if was processed
        if($upload->processed)
        {
            $destName = $upload->file_dst_name; 
            // create the thumb 
            unset($upload);  
            $upload = new Upload($destPath . $destName);
        	$destPath .= 'thumb/';
            $upload->file_new_name_body   = $fileName;
            $upload->no_script            = $this->settings['noScript'];;
            $upload->image_resize         = true;
            $upload->image_x              = $this->settings['thumbImageX'];
            $upload->image_y              = $this->settings['thumbImageY'];
            $upload->image_ratio          = true;
            $upload->process($destPath);
            if($upload->processed)
            	$this->savedFileName = $fileName . '.' . $upload->file_dst_name_ext;
            else
            {
            	$this->errors = $upload->error;
       			$result = false;
            }
        }
       	else
       	{
       		$this->errors = $upload->error;
       		$result = false;
       	}
       	return $result;
	}

	public function deleteImage($fileName)
	{
		$imagesPath = realpath(Yii::app()->getBasePath() . $this->settings['path'] . '/' . $fileName);
		$thumbImagesPath = realpath(Yii::app()->getBasePath() . $this->settings['path'] . '/thumb/' . $fileName);
			
		if(is_file($imagesPath))
            unlink($imagesPath);
   
   		if(is_file($thumbImagesPath))
            unlink($thumbImagesPath);
   	}
}