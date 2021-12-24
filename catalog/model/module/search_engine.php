<?php
class ModelModuleSearchEngine extends Model {

    private function remapTokenKeyboardLanguage($token, $fromLang, $toLang) {
        $mappings = [
            'en_ru' => [
                "a" => "ф", "b" => "и", "c" => "с", "d" => "в", "e" => "у", "f" => "а", "g" => "п", "h" => "р",
                "i" => "ш", "j" => "о", "k" => "л", "l" => "д", "m" => "ь", "n" => "т", "o" => "щ", "p" => "з",
                "r" => "к", "s" => "ы", "t" => "е", "u" => "г", "v" => "м", "w" => "ц", "x" => "ч", "y" => "н",
                "z" => "я", "q" => "й", ";" => "ж", "'" => "э", "," => "б", "." => "ю", "[" => "х", "]" => "ъ",

                "A" => "Ф", "B" => "И", "C" => "С", "D" => "В", "E" => "У", "F" => "А", "G" => "П", "H" => "Р",
                "I" => "Ш", "J" => "О", "K" => "Л", "L" => "Д", "M" => "Ь", "N" => "Т", "O" => "Щ", "P" => "З",
                "R" => "К", "S" => "Ы", "T" => "Е", "U" => "Г", "V" => "М", "W" => "Ц", "X" => "Ч", "Y" => "Н",
                "Z" => "Я", "Q" => "Й", ":" => "Ж", "\"" => "Э", "<" => "Б", ">" => "Ю", "{" => "Х", "}" => "Ъ",
            ],
            'en_ua' => [
                "a" => "ф", "b" => "и", "c" => "с", "d" => "в", "e" => "у", "f" => "а", "g" => "п", "h" => "р",
                "i" => "ш", "j" => "о", "k" => "л", "l" => "д", "m" => "ь", "n" => "т", "o" => "щ", "p" => "з",
                "r" => "к", "s" => "і", "t" => "е", "u" => "г", "v" => "м", "w" => "ц", "x" => "ч", "y" => "н",
                "z" => "я", "q" => "й", ";" => "ж", "'" => "є", "," => "б", "." => "ю", "[" => "х", "]" => "ї",

                "A" => "Ф", "B" => "И", "C" => "С", "D" => "В", "E" => "У", "F" => "А", "G" => "П", "H" => "Р",
                "I" => "Ш", "J" => "О", "K" => "Л", "L" => "Д", "M" => "Ь", "N" => "Т", "O" => "Щ", "P" => "З",
                "R" => "К", "S" => "І", "T" => "Е", "U" => "Г", "V" => "М", "W" => "Ц", "X" => "Ч", "Y" => "Н",
                "Z" => "Я", "Q" => "Й", ":" => "Ж", "\"" => "Є", "<" => "Б", ">" => "Ю", "{" => "Х", "}" => "Ї",
            ],
        ];

        $mappingKey = $fromLang . '_' . $toLang;
        $mapping = isset($mappings[ $mappingKey ]) ? $mappings[ $mappingKey ] : [];

        $remappedToken = '';
        for ($i = 0; $i < mb_strlen($token); $i++) {
            $letter = mb_substr($token, $i, 1);
            $remappedToken .= isset($mapping[ $letter ]) ? $mapping[ $letter ] : $letter;
        }

        return $remappedToken;
    }

    private function extractSearchStringTokens($searchString) {
        $searchString = preg_replace('/\+|<|>|\(|\)|~|\*|\"/', '', $searchString);
        $searchString = preg_replace('/-/', ' ', $searchString);
        $searchString = trim(preg_replace('/\s+/', ' ', $searchString));

        if (!$searchString) {
            return [];
        }

        $tokens = array_unique(explode(' ', $searchString));

        return $tokens;
    }

    private function collectSearchTokensGroups($searchTokens) {
        $this->load->model('tool/stemmer');

        $tokenGroups = [];
        foreach ($searchTokens as $token) {
            $tokenGroup = [ $token ];

            // Handle keyboard layout
            $tokenGroup[] = $this->remapTokenKeyboardLanguage($token, 'en', 'ru');
            $tokenGroup[] = $this->remapTokenKeyboardLanguage($token, 'en', 'ua');
            $tokenGroup = array_unique($tokenGroup);

            foreach ($tokenGroup as &$word) {
                $word = $this->model_tool_stemmer->stemWord($word);
            }
            $tokenGroup = array_unique($tokenGroup);

            $tokenGroups[] = $tokenGroup;
        }

        return $tokenGroups;
    }

    private function getFulltextMatchPattern($searchTokens) {
        $tokenGroups = $this->collectSearchTokensGroups($searchTokens);

        $tokenGroupsPatterns = [];
        foreach ($tokenGroups as $tokenGroup) {
            $isMultipleGroup = count($tokenGroup) > 1;

            foreach ($tokenGroup as $idx => &$token) {
                $relevancePrefix = '';
                if ($isMultipleGroup) {
                    $relevancePrefix = $idx == 0 ? '>' : '<';
                }
                $token = $relevancePrefix . $this->db->escape($token) . '*';
            }

            $pattern = implode(' ', $tokenGroup);
            $tokenGroupsPatterns[] = $isMultipleGroup ? '+('.$pattern.')' : '+'.$pattern;
        }

        $matchPattern = implode(' ', $tokenGroupsPatterns);

        return $matchPattern;
    }

    private function getProductSearchCondition($searchTokens) {
        $directTokens = [];
        foreach ($searchTokens as $idx => $token) {
            if (preg_match('/\d/', $token) || mb_strlen($token) <= 3) {
                $directTokens[] = $token;
                unset($searchTokens[ $idx ]);
            }
        }

        $condition = null;

        $fulltextPattern = $this->getFulltextMatchPattern($searchTokens);
        if ($fulltextPattern) {
            $condition = "MATCH (pd.name,pd.meta_h1) AGAINST ('{$fulltextPattern}' IN BOOLEAN MODE)";
        }

        if ($directTokens) {
            $directPattern = "%".implode('%', $directTokens)."%";
            $directCondition = "pd.name LIKE '{$directPattern}' OR pd.meta_h1 LIKE '{$directPattern}'";


            $directCondition .= " OR LCASE(p.sku) = '{$directPattern}'";
            $directCondition .= " OR LCASE(p.mpn) LIKE  '{$directPattern}'";
            if (count($directTokens) == 1) {
                $directCondition .= " OR p.model LIKE '{$directPattern}'";
            }

            if ($condition) {
                $condition .= " AND ( {$directCondition} )";
            } else {
                $condition = $directCondition;
            }
        }
        // vdump($condition);
        if (!$condition) {
            return null;
        }

        return " (" . $condition . ") ";
    }

    private function getCategorySearchCondition($searchTokens) {
        $directTokens = [];
        foreach ($searchTokens as $idx => $token) {
            if (mb_strlen($token) <= 3) {
                $directTokens[] = $token;
                unset($searchTokens[ $idx ]);
            }
        }

        $condition = null;

        $fulltextPattern = $this->getFulltextMatchPattern($searchTokens);
        if ($fulltextPattern) {
            $directCondition = '';
            if ($directTokens) {
                $directPattern = "%".implode('%', $directTokens)."%";
                $directCondition .= "AND cd.name LIKE '{$directPattern}'";
            }
                $directConditionCompability='';
                foreach($searchTokens as $token){
                  $directConditionCompability .= " OR LCASE(ac.model) LIKE LCASE('%{$token}%') OR LCASE(ac.child_model) LIKE LCASE('%{$token}%')";
                }


            // maxis: доработан запрос для поиска в совместимых устройствах
            // OR p.product_id IN (
            // SELECT DISTINCT ac.child_product_id
            // FROM oc_product_compability as ac
            // WHERE MATCH (ac.model) AGAINST ('{$fulltextPattern}' IN BOOLEAN MODE) {$directConditionCompability}
            // )

            $condition = "
            p.product_id IN (
            SELECT DISTINCT p2c.product_id
            FROM oc_category_description cd
            INNER JOIN oc_product_to_category p2c ON (cd.category_id = p2c.category_id)
            WHERE MATCH (cd.name) AGAINST ('{$fulltextPattern}' IN BOOLEAN MODE) {$directCondition}
            ) OR p.product_id IN (
            SELECT DISTINCT ac.child_product_id
            FROM oc_product_compability as ac
            WHERE MATCH (ac.model) AGAINST ('{$fulltextPattern}' IN BOOLEAN MODE) {$directConditionCompability}
            )
            ";
        }

        if (!$condition) {
            return null;
        }

        return " (" . $condition . ") ";
    }

    public function getSearchCondition($searchString) {
        $tokens = $this->extractSearchStringTokens($searchString);
vdump($tokens);
        $conditions = [];
        $productCondition = $this->getProductSearchCondition($tokens);
        vdump($productCondition);
        if ($productCondition) {
            $conditions[] = $productCondition;
        }

        $categoryCondition = $this->getCategorySearchCondition($tokens);
        if ($categoryCondition) {
            $conditions[] = $categoryCondition;
        }

        if (!$conditions) {
            return " FALSE ";
        }

        return " (" . implode(" OR ", $conditions) . ") ";
    }
}