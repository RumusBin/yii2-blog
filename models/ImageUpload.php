<?php
/**
 * Created by PhpStorm.
 * User: rumus
 * Date: 07.06.17
 * Time: 22:00
 */

namespace app\models;


use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ImageUpload extends Model
{
    public $image;

    public function rules()
    {
        return [
            [['image'], 'required'],
            [['image'], 'file', 'extensions'=>'jpg, jpeg, png']
        ];
    }

    public function uploadFile(UploadedFile $file, $currentImage)
    {

        $this->image = $file;

        if ($this->validate())
        {

            $this->deleteCurrentImage($currentImage);

            return $this->saveImage();
        }
    }

    public function uniqFileName()
    {
        return strtolower(md5(uniqid($this->image->baseName))). '.' . $this->image->extension;
    }

    public function getFolder()
    {
        return Yii::getAlias('@web').'uploads/';
    }

    public function deleteCurrentImage($currentImage)
    {
        if($this->fileExists($currentImage) && !empty($currentImage))
        {
            unlink($this->getFolder() . $currentImage);
        }
    }

    public function fileExists($currentImage)
    {
        return file_exists($this->getFolder() . $currentImage);
    }

    public function saveImage()
    {
        $fileName = $this->uniqFileName();

        $this->image->saveAs($this->getFolder() . $fileName);

        return $fileName;
    }
}