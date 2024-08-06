<?php
namespace TextFiller;

use MyUtility\MyUtility;
use PhpOffice\PhpWord\Shared\ZipArchive;
use yii\validators\FileValidator;


class DocxReplacer extends Replacer
{
    private $outputFile;

    public function renderButton(TextFiller $textFiller)
    {
        \Yii::$app->view->params['id'] = $textFiller->id;
        \Yii::$app->view->params['templateTypeName'] = $textFiller->templateTypeName;
				\Yii::$app->view->params['templatePath'] = $textFiller->templatePath;
        \Yii::$app->view->params['phrasesHint'] = $textFiller->phrasesHint;
				\Yii::$app->view->params['buttonText'] = $textFiller->buttonText;
        echo \Yii::$app->view->renderFile("@app/widgets/TextFiller/views/button.php");
    }

    public function replace(TextFiller $textFiller): bool
    {
        MyUtility::cleanDir(\Yii::$app->basePath."/temp/");
        $this->outputFile = \Yii::$app->basePath."/temp/out.docx";
        $zip = new ZipArchive();

        try {
            if (!copy(\Yii::getAlias('@commonFolders/DocTemplates/').$textFiller->templatePath, $this->outputFile)) {
                throw new \Exception('Не удалось скопировать шаблон');
            };
        }
        catch (\Exception $e){
            header("Location: ".$_SERVER['HTTP_REFERER']);
            exit;
        }

        // Open the Microsoft Word .docx file as if it were a zip file... because it is.
        if ($zip->open($this->outputFile, ZipArchive::CREATE)!==TRUE) {
            echo "Cannot open $this->outputFile :( "; die;
        }

        // Fetch the document.xml file from the word subdirectory in the archive.
        $xml = $zip->getFromName('word/document.xml');

        // Replace the strings

        $textFiller->phrases['currentDate'] = date('d.m.Y');
        $xml = strtr($xml, $textFiller->implodeTags($textFiller->phrases));

        // Write back to the document and close the object
        $zip->addFromString('word/document.xml', $xml);

        $zip->close();
        copy($this->outputFile, \Yii::$app->basePath."/temp/test.docx");
        return true;
        
    }

    public function output(TextFiller $textFiller)
    {
        if (file_exists($this->outputFile)) {
            if (ob_get_level()) {
                ob_end_clean();
            }
            \Yii::$app->response->sendFile($this->outputFile, $textFiller->templatePseudoName . ' ' . $textFiller->postfix . '.docx');
        }else {
            throw new \Exception('Файл не найден');
		        header("Location: ".$_SERVER['HTTP_REFERER']);
        }
    }
}
