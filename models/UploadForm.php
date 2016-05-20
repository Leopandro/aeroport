<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $file;
//    public function rules()
//    {
//        return [
//            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'jpg, jpeg, png'],
//        ];
//    }

    public function upload($folder = 'images')
    {
        $path = Yii::getAlias('@app/web/'.$folder.'/');
        if (!is_dir($path)) mkdir($path, 0777, true);
        $filename = Yii::$app->security->generateRandomString(9);
        $this->file->saveAs($path . $filename . '.' . $this->file->extension);
        return $filename . '.' . $this->file->extension;
}
}