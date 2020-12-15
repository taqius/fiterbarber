<?php


// require __DIR__ . '/autoload.php';


// namespace Mike42\Escpos\Printer;

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;

class MyCoolPrinter extends Mike42\Escpos\Printer
{

    // Print image inline. If it is a multi-line image, then only the first line is printed!
    public function inlineImage(EscposImage $img, $size = Printer::IMG_DEFAULT)
    {
        $highDensityVertical = !(($size & self::IMG_DOUBLE_HEIGHT) == Printer::IMG_DOUBLE_HEIGHT);
        $highDensityHorizontal = !(($size & self::IMG_DOUBLE_WIDTH) == Printer::IMG_DOUBLE_WIDTH);
        // Header and density code (0, 1, 32, 33) re-used for every line
        $densityCode = ($highDensityHorizontal ? 1 : 0) + ($highDensityVertical ? 32 : 0);
        $colFormatData = $img->toColumnFormat($highDensityVertical);
        $header = Printer::dataHeader(array($img->getWidth()), true);
        foreach ($colFormatData as $line) {
            // Print each line, double density etc for printing are set here also
            $this->connector->write(self::ESC . "*" . chr($densityCode) . $header . $line);
            break;
        }
    }
}
