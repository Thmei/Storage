<?php
/**
The MIT License

Copyright 2016 ekegulsk.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/
/**
    Created on : Feb 24, 2016, 9:57:43 PM
    Author     : ekegulsk
    Uses code snippets from W3C website: http://www.w3schools.com/php/php_file_upload.asp
*/
    require_once 'DatabaseTableHandler.php';
/**
 * Provides logging functinality
 * Also keeps track of last error set
 */
class Logging{
    const DEBUG = false;
    protected $_error = "";
        
    public function LOG_WARNING($str){
        if(Logging::DEBUG){
            echo "WARNING: " . '[' . get_class($this) . '] ' . $str . "<br>";
        }
    }
    public function LOG_ERROR($str){
         if(Logging::DEBUG){  
             echo "ERROR: " . '[' . get_class($this) . '] ' . $str . "<br>";
         }
         $this->_error = $str;
    }
    public function LOG_DEBUG($str){
        if(Logging::DEBUG){
            echo "DEBUG: " . '[' . get_class($this) . '] ' . $str . "<br>";
        }
    }
}

/**
 * Provides general file upload functionality
 */
class fileUploader extends Logging{
    const MAX_FILE_SIZE = 10000000;
    
    protected $_target_dir = "";
    protected $_srcFile = "";
    protected $_srcFileSize = "";
    protected $_srcFileName = "";
    protected $_targetFilePath = "";
   
    public function __construct() {

    }
    
    public function setTargetDir($absolutePath){
        $this->LOG_DEBUG($this->_target_dir);                
        $this->_target_dir = $absolutePath;
    }
    
    public function saveFile($srcFile, $fileName, $fileSize, $newName){
        $uploadOk = 1;
        mkdir($this->_target_dir, 0777 , true); // recursively make folder as needed
        if($newName != "")
        {
            $path_parts = pathinfo($fileName);
            $ext = $path_parts['extension'];
            $fileName = $newName . '.' . $ext;
        }
        $fullPath = $this->_target_dir . '/' . $fileName;
        
        // Check if file already exists
        if (file_exists($fullPath)) {
            $this->LOG_ERROR("Sorry, file already exists.");
            $uploadOk = 0;
        }
                // Check file size
        if ( $fileSize > fileUploader::MAX_FILE_SIZE) {
            $this->LOG_ERROR("Sorry, your file is too large.");
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $this->LOG_ERROR("Sorry, your file was not uploaded.");
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($srcFile, $fullPath)) {
                $this->LOG_DEBUG("The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.");
                $this->_targetFilePath = $fullPath;
            } else {
                $this->LOG_ERROR("Sorry, there was an error uploading your file to " . $fullPath);
            }
        }
        if($uploadOk)
            return $fileName;
        else
            return null;
    }
}

/**
 * Provides image file validation and resizing functionality
 */
class ImageUploader extends fileUploader{
    protected $_smallImgScale = 0.1;
    protected $_medImgScale = 0.5;
    protected $_srcHeight = "";
    protected $_srcWidth = "";
    protected $_imgType = "";
    protected $_imgDescription = "";
    protected $_imgTitle = "";

    public function __construct() {
        parent::__construct();
    }
    
    public function checkValidImage($srcFile){
        $isImage = false;
        
        if($srcFile === ""){
            $this->LOG_ERROR("No file selected.");
            return false;
        }
        // Check if a file is a actual image or fake image
        list($this->_srcWidth, $this->_srcHeight, $this->_imgType) = getimagesize($srcFile);
        
        if($this->_imgType === IMG_GIF || $this->_imgType === IMG_JPG || $this->_imgType === IMG_JPEG || $this->_imgType === IMG_PNG || $this->_imgType == IMAGETYPE_PNG){
            $isImage = true;
        }
        
        if($isImage) {
            $this->LOG_DEBUG("File is an image - " . $this->_imgType. ".");
        } else {
            $this->LOG_ERROR("File {$this->_srcFileName} is not an image! Please specify valid image file");
        }        
        return $isImage;
    }
    
    public function makeCopy($scaleFactor, $filename){
        $copiedFilePath = "";
        $new_width = $this->_srcWidth * $scaleFactor;
        $new_height = $this->_srcHeight * $scaleFactor;
        // Resample
        $image_p = imagecreatetruecolor($new_width, $new_height);
        switch($this->_imgType){
            case IMG_JPG:
            case IMG_JPEG:
                $image = imagecreatefromjpeg($this->_targetFilePath);
                // scale and save
                imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $this->_srcWidth, $this->_srcHeight);
                $copiedFilePath = $this->_target_dir . '/' . $filename . ".jpeg";
                imagejpeg($image_p, $copiedFilePath);
                break;
            case IMG_GIF:
                $image = imagecreatefromgif($this->_targetFilePath); //gif file
                imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height,  $this->_srcWidth, $this->_srcHeight);
                $copiedFilePath = $this->_target_dir . '/' . $filename . ".gif";
                imagegif($image_p, $copiedFilePath);
                break;
            case IMG_PNG:
            case IMAGETYPE_PNG:
                $image = imagecreatefrompng($this->_targetFilePath); //png file
                imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height,  $this->_srcWidth, $this->_srcHeight);
                $copiedFilePath = $this->_target_dir . '/' . $filename . ".png";
                imagepng($image_p, $copiedFilePath);     
              break;
            default: 
                $this->LOG_ERROR("Uknown image type = " . $this->_imgType);
        }
        
        return $copiedFilePath;
    }
    
    public function uploadImage($tempImgPath, $targetDir, $imgFileName, $imgFileSize){
        if($this->checkValidImage($tempImgPath)){

            $this->setTargetDir($targetDir);
            $original = $this->saveFile($tempImgPath, $imgFileName, $imgFileSize, "original");

            if($original){
                $small = $this->makeCopy($this->_smallImgScale,"small");
                $medium = $this->makeCopy($this->_medImgScale, "medium" );
            
                $this->_error = "";
                return Array("original"=>basename($original), "medium"=>basename($medium),"small"=>basename($small));
            }
        }
        if($this->_error !== ""){
            return $this->_error;
        }
    }
}

?>
