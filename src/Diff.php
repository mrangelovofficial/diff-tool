<?php
declare(strict_types=1);
namespace Mrangelovofficial\Diff;

class Diff {

    private int $maxLinesToCompare = 0;

    public function __construct(
        private string $originalFile,
        private string $targetFile) {
            $this->findLinesToCompare();
    }
    
    public function getOriginalString() : string {
        return nl2br(htmlspecialchars($this->originalFile));
    }

    public function getTargetString() : string {
        return nl2br(htmlspecialchars($this->targetFile));
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

        for ($line=0; $line < $this->maxLinesToCompare; $line++) { 
            $originalLine   = $originalLines[$line] ?? null;
            $targetLine     = $targetLines[$line] ?? null;

            $lines  .=  $this->prettyFormatLine($originalLine, $targetLine, $line);
        }

        return $lines;
    }

    private function findLinesToCompare(): void {
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

        $this->maxLinesToCompare = $lines;
    }

    private function prettyFormatLine(?string $originalLine, ?string $targetLine, int $lineNumber) : string {
        $linesFormatted = "";

        if($originalLine === $targetLine) {
            $linesFormatted .= "<p class='defaultDiff'>$lineNumber: $originalLine </p>";
        }else {
            if(!is_null($originalLine)) {
                $linesFormatted .= "<p class='oldDiff defaultDiff'>$lineNumber:- $originalLine </p>";
            }

            if(!is_null($targetLine)) {
                $linesFormatted .= "<p class='newDiff defaultDiff'>$lineNumber:+ $targetLine</p>";
            }
        }

        return $linesFormatted;
    }
}