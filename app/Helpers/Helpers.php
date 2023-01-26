<?php

namespace App\Helpers;

class Helpers {
    static function removeSquareBrackets($data) {
        $data = $data ?? '';
        $valid = true;
        $validSequences = ['[]', '{}', '()'];

        if (strlen($data) % 2 > 0) {
            return false;
        }
    
        while (strlen($data) > 0 && $valid) {
            $splits = str_split($data);
            $validSequence = false;
            $index = 0;
            $equals = 0;
    
            foreach ($splits as $key => $split) {
                if ($key > 0 && $split === $data[0]) {
                    $equals++;
                }

                if ($key % 2 > 0 && $equals === 0 && in_array($data[0].$split, $validSequences)) {
                    $index = $key;
                    $validSequence = true;
                    break;
                }

                if ($equals > 0 && in_array($data[0].$split, $validSequences)) {
                    $equals--;
                }
            }
    
            if (!$validSequence) {
                $valid = false;
                break;
            } else {
                array_splice($splits, $index, 1);
                array_splice($splits, 0, 1);
                $data = implode('', $splits);
            }
        }
    
        return $valid;
    }
}
