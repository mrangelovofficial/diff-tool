<?php
declare(strict_types=1);
namespace Mrangelovofficial\Diff;

class Diff {

    private int $lines = 0;

    public function __construct(
        private string $originalFile,
        private string $targetFile){
            $this->findLinesToCompare();
        }
    
    public function getOriginalString() : string {
        return nl2br($this->originalFile);
    }

    public function getTargetString() : string {
        return nl2br($this->targetFile);
    }

    public function getDiff() : string {
        return $this->compare();
    }

    private function getOriginalLines() : array {
        return preg_split("/((\r?\n)|(\r\n?))/", $this->getOriginalString());
    }

    private function getTargetLines() : array {
        return preg_split("/((\r?\n)|(\r\n?))/", $this->getTargetString());
    }

    private function compare() : string {
        $originalLines  = $this->getOriginalLines();
        $targetLines    = $this->getTargetLines();
        $lines          = "";

        for ($line=0; $line < $this->lines; $line++) { 
            $originalLine   = $originalLines[$line] ?? "";
            $targetLine     = $targetLines[$line] ?? "";

            $lines .= $line . ": ";
            if($originalLine === $targetLine) {
                $lines .= $originalLine;
            }else {
                $lines .= $originalLine;
            }
            $lines .= "\r\n";
        }

        return $lines;
    }

    private function findLinesToCompare(): void{
        $originalLinesCount  = count($this->getOriginalLines());
        $targetLinesCount   = count($this->getTargetLines());
        $lines = 0;

        if($originalLinesCount === $targetLinesCount) {
            $lines = $originalLinesCount;
        }else if($originalLinesCount     >= $targetLinesCount) {
            $lines = $originalLinesCount;
        }else {
            $lines = $targetLinesCount;
        }

        $this->lines = $lines;
    }
}